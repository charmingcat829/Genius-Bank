<?php

namespace App\Http\Controllers\Subscription;

use App\Repositories\SubscriptionRepository;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use App\Models\UserSubscription;
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
    Auth\OAuthTokenCredential
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PaypalController extends Controller
{
    private $_api_context;
    public $subscriptionRepositorty;

    public function __construct(SubscriptionRepository $subscriptionRepositorty)
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

        $this->subscriptionRepositorty = $subscriptionRepositorty;
    }

    public function store(Request $request){
        $settings = Generalsetting::findOrFail(1);

        $return_url = route('front.index');
        $cancel_url = route('subscription.paypal.cancle');
        $notify_url = route('subscription.paypal.notify');

        $item_name = $settings->title." Subscription";
        $item_amount = $request->price;
        $item_number = Str::random(4).time();

        $support = ['USD','EUR'];
        if(!in_array($request->currency_code,$support)){
            return redirect()->back()->with('warning','Please Select USD Or EUR Currency For Paypal.');
        }
       
        $addionalData = ['subscription_number'=>$item_number];
        $this->subscriptionRepositorty->order($request,'pending',$addionalData);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $item_1 = new Item();
        $item_1->setName($item_name)
            ->setCurrency($request->currency_code)
            ->setQuantity(1)
            ->setPrice($item_amount);
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($request->currency_code)
            ->setTotal($item_amount);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($item_name.' Via Paypal');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl($notify_url)
            ->setCancelUrl($cancel_url);
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            
            
            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                return redirect()->back()->with('warning',$ex->getMessage());
            }
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
           
            Session::put('paypal_data',$request->all());
            Session::put('paypal_payment_id', $payment->getId());
            Session::put('order_number',$item_number);

            if (isset($redirect_url)) {
                return Redirect::away($redirect_url);
            }


            return redirect()->back()->with('warning','Unknown error occurred');

            if (isset($redirect_url)) {
                return Redirect::away($redirect_url);
            }
            return redirect()->back()->with('warning','Unknown error occurred');
    }

    public function notify(Request $request)
    {

        $payment_id = Session::get('paypal_payment_id');
        if (empty( $request['PayerID']) || empty( $request['token'])) {
            return redirect()->back()->with('error', 'Payment Failed'); 
        } 

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request['PayerID']);


        $order_number = Session::get('order_number');


        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            $resp = json_decode($payment, true);
            $subscription = UserSubscription::where('subscription_number',$order_number)->where('status','pending')->first();
            $subscription->status = "completed";
            $subscription->txnid = $resp['transactions'][0]['related_resources'][0]['sale']['id'];
            $subscription->update();

            $this->subscriptionRepositorty->callAfterOrder($request,$subscription);

            Session::forget('paypal_data');
            Session::forget('paypal_payment_id');
            Session::forget('order_number');

            return redirect()->route('user.dashboard')->with('message','Bank Plan Updated');
        }

    }
}
