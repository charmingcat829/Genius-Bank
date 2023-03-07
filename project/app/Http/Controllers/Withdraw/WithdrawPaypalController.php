<?php

namespace App\Http\Controllers\Withdraw;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Classes\GeniusMailer;
use App\Models\Currency;
use App\Models\Withdraw;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\Transaction as AppTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\BankPlan;
use App\Models\User;
use App\Models\WithdrawMethod;
use Illuminate\Support\Facades\Input;
use Validator;

use PayPal\{
    Api\Item,
    Api\Payer,
    Api\Amount,
    Api\Payment,
    Api\ItemList,
    Rest\ApiContext,
    Api\Transaction,
    Api\RedirectUrls,
    Api\PaymentExecution,
    Auth\OAuthTokenCredential,
    Api\Payout,
    Api\PayoutSenderBatchHeader,
    Api\PayoutItem,
    Api\PayoutItemDetail
};

class WithdrawPaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {

        $data = PaymentGateway::whereKeyword('paypal')->first();
        $paydata = $data->convertAutoData();

        $paypal_conf = \Config::get('paypal');
        $paypal_conf['client_id'] = $paydata['client_id'];
        $paypal_conf['secret'] = $paydata['client_secret'];
        $paypal_conf['settings']['mode'] = $paydata['sandbox_check'] == 1 ? 'sandbox' : 'live';
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
        
    }

    public function store(Request $request){
        $request->validate([
            'amount' => 'required|gt:0',
        ]);
        
        $settings = Generalsetting::findOrFail(1);
        
        $support = ['USD','EUR'];
        if(!in_array($request->currency_code,$support)){
            return redirect()->back()->with('warning','Please Select USD Or EUR Currency For Paypal.');
        }

        $user = auth()->user();

        if($user->bank_plan_id === null){
            return redirect()->back()->with('unsuccess','You have to buy a plan to withdraw.');
        }

        if(now()->gt($user->plan_end_date)){
            return redirect()->back()->with('unsuccess','Plan Date Expired.');
        }

        $bank_plan = BankPlan::whereId($user->bank_plan_id)->first();
        $dailyWithdraws = Withdraw::whereDate('created_at', '=', date('Y-m-d'))->whereStatus('completed')->sum('amount');
        $monthlyWithdraws = Withdraw::whereMonth('created_at', '=', date('m'))->whereStatus('completed')->sum('amount');

        if($dailyWithdraws > $bank_plan->daily_withdraw){
            return redirect()->back()->with('unsuccess','Daily withdraw limit over.');
        }

        if($monthlyWithdraws > $bank_plan->monthly_withdraw){
            return redirect()->back()->with('unsuccess','Monthly withdraw limit over.');
        }

        if(baseCurrencyAmount($request->amount) > $user->balance){
            return redirect()->back()->with('unsuccess','Insufficient Account Balance.');
        }

        $withdrawcharge = WithdrawMethod::whereMethod($request->methods)->first();
        $charge = $withdrawcharge->fixed;
        
        $messagefee = (($withdrawcharge->percentage / 100) * $request->amount) + $charge;
        $messagefinal = $request->amount - $messagefee;

        $currency = Currency::whereId($request->currency_id)->first();
        $amountToAdd = $request->amount/$currency->value;


        $amount = $amountToAdd;
        $fee = (($withdrawcharge->percentage / 100) * $amount) + $charge;
        $finalamount = $amount - $fee;

        if($finalamount < 0){
            return redirect()->back()->with('unsuccess','Request Amount should be greater than this '.$amountToAdd.' (USD)');
        }

        if($finalamount > $user->balance){
            return redirect()->back()->with('unsuccess','Insufficient Balance.');
        }
        
        $finalamount = number_format((float)$finalamount,2,'.','');
        $withdraw_amount = array("value" => "{$finalamount}", "currency" => "USD");
        $withdraw_amount = json_encode($withdraw_amount);
        
        $user->balance = $user->balance - $amount;
        $user->update();

        $cancel_url = action('Withdraw\WithdrawPaypalController@cancle');
        $notify_url = action('Withdraw\WithdrawPaypalController@notify');

        $txnid = Str::random(12);
        $newwithdraw = new Withdraw();
        $newwithdraw['user_id'] = auth()->id();
        $newwithdraw['method'] = $request->methods;
        $newwithdraw['txnid'] = $txnid;

        $newwithdraw['amount'] = $finalamount;
        $newwithdraw['fee'] = $fee;
        $newwithdraw['details'] = $request->details;
        $newwithdraw->save();

        $trans = new AppTransaction();
        $trans->email = $user->email;
        $trans->amount = $finalamount;
        $trans->type = "Payout";
        $trans->profit = "minus";
        $trans->txnid = $txnid;
        $trans->user_id = $user->id;
        $trans->save();

        $email = $request->email;
        $payouts = new Payout();
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId(uniqid())
            ->setEmailSubject("You have a Payout!");
        $senderItem = new PayoutItem();

        $senderItem->setRecipientType('Email')
            ->setNote('Thanks for your patronage!')
            ->setReceiver($request->email) //forever14sanchez@icloud.com
            ->setSenderItemId(uniqid())
            ->setAmount(new \PayPal\Api\Currency($withdraw_amount));
        $payouts->setSenderBatchHeader($senderBatchHeader)
            ->addItem($senderItem);

        try {
            $output = $payouts->create(null, $this->_api_context);

        } catch (\Exception $e) {
            print_r($e);
        }
        $redirect_url = null;

        foreach($output->getLinks() as $link) {
            if($link->getRel() == 'self') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        $payout_batch_id = $output->batch_header->payout_batch_id;
        $payout = Payout::get($payout_batch_id, $this->_api_context);
               
        return redirect()->back()->with('success','Withdraw Request Amount : '.$request->amount.' Fee : '.$messagefee.' = '.$messagefinal.' ('.$currency->name.') Sent Successfully.');
    }

    public function notify(Request $request)
    {

        $user = auth()->user();
        $withdraw_data = Session::get('withdraw_data');

        $payment_id = Session::get('paypal_payment_id');
        if (empty( $request['PayerID']) || empty( $request['token'])) {
            return redirect()->back()->with('error', 'Payment Failed');
        }

        $payment = Payout::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request['PayerID']);


        $withdraw_number = Session::get('withdraw_number');
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $resp = json_decode($payment, true);

                $withdraw = Withdraw::where('txnid',$withdraw_number)->where('status','pending')->first();
                $data['txnid'] = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
                $data['status'] = "complete";
                $withdraw->update($data);

                $gs =  Generalsetting::findOrFail(1);


                if($gs->is_smtp == 1)
                {
                    $data = [
                        'to' => $user->email,
                        'type' => "Withdraw",
                        'cname' => $user->name,
                        'oamount' => $withdraw->amount,
                        'aname' => "",
                        'aemail' => "",
                        'wtitle' => "",
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendAutoMail($data);
                }
                else
                {
                    $to = $user->email;
                    $subject = " You have withdrawed successfully.";
                    $msg = "Hello ".$user->name."!\nYou have invested successfully.\nThank you.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    mail($to,$subject,$msg,$headers);
                }

                $user->balance -= $withdraw->amount;
                $user->save();

                $trans = new AppTransaction();
                $trans->email = $user->email;
                $trans->amount = $withdraw->amount;
                $trans->type = "Payout";
                $trans->profit = "minus";
                $trans->txnid = $withdraw->txnid;
                $trans->user_id = $user->id;
                $trans->save();

                Session::forget('withdraw_data');
                Session::forget('paypal_payment_id');
                Session::forget('withdraw_number');

                return redirect()->route('user.withdraw.create')->with('success','withdraw amount '.$withdraw->amount.' (USD) successfully!');
        }

    }
}
