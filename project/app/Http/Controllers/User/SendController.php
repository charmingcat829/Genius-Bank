<?php

namespace App\Http\Controllers\User;

use App\Classes\GeniusMailer;
use App\Http\Controllers\Controller;
use App\Models\BalanceTransfer;
use App\Models\BankPlan;
use App\Models\Generalsetting;
use App\Models\SaveAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Str;

class SendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        $data['saveAccounts'] = SaveAccount::whereUserId(auth()->id())->orderBy('id','desc')->get();
        $data['savedUser'] = NULL;

        return view('user.sendmoney.create',$data);
    }

    public function savedUser($no){
        $data['savedUser'] = User::whereAccountNumber($no)->first();
        $data['saveAccounts'] = SaveAccount::whereUserId(auth()->id())->orderBy('id','desc')->get();

        return view('user.sendmoney.create',$data);
    }

    public function success(){
        if(session('saveData') && session('sendstatus') == 1){
            $data['data'] = session()->get('saveData');

            session(['sendstatus'=>0]);
            return view('user.sendmoney.success',$data);
        }else{
            session(['sendstatus'=>0]);
            $data['savedUser'] =  NULL;
            $data['saveAccounts'] = SaveAccount::whereUserId(auth()->id())->orderBy('id','desc')->get();

            return view('user.sendmoney.create',$data);
        }
    }

    public function store(Request $request){

        $request->validate([
            'account_number' => 'required',
            'account_name' => 'required',
            'amount' => 'required|numeric|min:0'
        ]);

        $user = auth()->user();

        if($user->bank_plan_id === null){
            return redirect()->back()->with('unsuccess','You have to buy a plan to withdraw.');
        }

        if(now()->gt($user->plan_end_date)){
            return redirect()->back()->with('unsuccess','Plan Date Expired.');
        }

        $bank_plan = BankPlan::whereId($user->bank_plan_id)->first();
        $dailySend = BalanceTransfer::whereUserId(auth()->id())->whereDate('created_at', '=', date('Y-m-d'))->whereStatus(1)->sum('amount');
        $monthlySend = BalanceTransfer::whereUserId(auth()->id())->whereMonth('created_at', '=', date('m'))->whereStatus(1)->sum('amount');

        if($dailySend > $bank_plan->daily_send){
            return redirect()->back()->with('unsuccess','Daily send limit over.');
        }

        if($monthlySend > $bank_plan->monthly_send){
            return redirect()->back()->with('unsuccess','Monthly send limit over.');
        }

        $gs = Generalsetting::first();
        $amount = baseCurrencyAmount($request->amount);

        if($request->account_number == $user->account_number){
            return redirect()->back()->with('unsuccess','You can not send money yourself!!');
        }

        if($request->amount < 0){
            return redirect()->back()->with('unsuccess','Request Amount should be greater than this!');
        }

        if($amount > $user->balance){
            return redirect()->back()->with('unsuccess','Insufficient Balance.');
        }

        if($receiver = User::where('account_number',$request->account_number)->first()){
            $txnid = Str::random(4).time();
            $data = new BalanceTransfer();
            $data->user_id = auth()->user()->id;
            $data->receiver_id = $receiver->id;
            $data->transaction_no = $txnid;
            $data->type = 'own';
            $data->cost = 0;
            $data->amount = $amount;
            $data->status = 1;
            $data->save();

            $receiver->increment('balance',$amount);
            $user->decrement('balance',$amount);

            if(SaveAccount::whereUserId(auth()->id())->where('receiver_id',$data->receiver_id)->exists()){
                return redirect()->route('send.money.create')->with('success','Money Send Successfully');
            }

            session(['sendstatus'=>1, 'saveData'=>$data]);

            $trans = new Transaction();
            $trans->email = $user->email;
            $trans->amount = $amount;
            $trans->type = "Send Money";
            $trans->profit = "minus";
            $trans->txnid = $txnid;
            $trans->user_id = $user->id;
            $trans->save();

            $receiverTransaction = new Transaction();
            $receiverTransaction->email = $receiver->email;
            $receiverTransaction->amount = $amount;
            $receiverTransaction->type = "Send Money";
            $receiverTransaction->profit = "plus";
            $receiverTransaction->txnid = $txnid;
            $receiverTransaction->user_id = $receiver->id;
            $receiverTransaction->save();

            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $receiver->email,
                    'type' => "Send money",
                    'cname' => $receiver->name,
                    'oamount' => $request->amount,
                    'aname' => "",
                    'aemail' => "",
                    'wtitle' => "",
                ];

                $mailer = new GeniusMailer();
                $mailer->sendAutoMail($data);
            }
            else
            {
                $to = $receiver->email;
                $subject = " Money send successfully.";
                $msg = "Hello ".$receiver->name."!\nMoney send successfully.\nThank you.";
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,$subject,$msg,$headers);
            }

            return redirect()->route('user.send.money.success');
        }else{
            return redirect()->back()->with('unsuccess','Sender not found!');
        }
    }

    public function saveAccount(Request $request){
        $savedUser = SaveAccount::whereUserId(auth()->id())->where('receiver_id',$request->receiver_id)->first();

        if($savedUser){
            return redirect()->route('send.money.create')->with('success','Already in Beneficiary.');
        }
        $data = new SaveAccount();

        $data->user_id = $request->user_id;
        $data->receiver_id = $request->receiver_id;
        $data->save();

        return redirect()->route('send.money.create')->with('success','Money Send Successfully');
    }

    public function cancle(){
        return redirect()->route('send.money.create')->with('success','Money Send Successfully');
    }


}
