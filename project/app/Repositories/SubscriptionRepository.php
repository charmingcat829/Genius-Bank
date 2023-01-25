<?php
namespace App\Repositories;

use App\Classes\GeniusMailer;
use App\Models\Currency;
use App\Models\Generalsetting;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Session;

class SubscriptionRepository{
    public $gs;

    public function __construct()
    {
        $this->gs = Generalsetting::findOrFail(1);
    }

    public function order($request,$status,$addionalData){
        $subscription = new UserSubscription();

        if($request->currency_id){
            $currencyValue = Currency::where('id',$request->currency_id)->first();
        }

        if($request->currency_id){
            $subscription->price = $request->price/$currencyValue->value;
        }

        if(isset($addionalData['subscription_number'])){
            $subscription->subscription_number = $addionalData['subscription_number'];
        }

        $subscription->user_id = $request->user_id;
        $subscription->bank_plan_id = $request->bank_plan_id;
        $subscription->currency_id = $request->currency_id;
        $subscription->method = $request->method;
        $subscription->days = $request->days;


        if(isset($addionalData['status'])){
            $subscription->status = "completed";
        }else{
            $subscription->status = "pending";
        }

        if(isset($addionalData['txnid'])){
            $subscription->txnid = $addionalData['txnid'];
        }

        $subscription->save();

        if($status == 'complete'){
            $this->callAfterOrder($request,$subscription);
        }
    }

    public function OrderFromSession($request,$status,$addionalData){
        $input = Session::get('input_data');

        $subscription = new UserSubscription();

        if($input['currency_id']){
            $currencyValue = Currency::where('id',$input['currency_id'])->first();
        }

        if($input['currency_id']){
            $subscription->price = $input['price']/$currencyValue->value;
        }else{
            $subscription->price = $input['price'];
        }

        if(isset($addionalData['subscription_number'])){
            $subscription->subscription_number = $addionalData['subscription_number'];
        }

        $subscription->user_id = $input['user_id'];
        $subscription->bank_plan_id = $input['bank_plan_id'];
        $subscription->currency_id = $input['currency_id'];
        $subscription->method = $input['method'];
        $subscription->days = $input['days'];

        if(isset($addionalData['txnid'])){
            $subscription->txnid = $addionalData['txnid'];
        }
        $subscription->status = "completed";
        $subscription->save();

        if($status == 'complete'){
            $this->callAfterOrder($request,$subscription);
        }
    }

    public function callAfterOrder($request,$subscription){
        $this->UserPlanUpdate($subscription);
        $this->createTransaction($subscription);
    }

    public function UserPlanUpdate($subscription){
        $user = User::findorFail($subscription->user_id);
        if($user){
            $user->bank_plan_id = $subscription->bank_plan_id;
            $user->plan_end_date = $user->plan_end_date->addDays($subscription->days);
            $user->update();
        }
    }

    public function createTransaction($subscription){
        $user = User::findOrFail($subscription->user_id);
        $trans = new Transaction();
        $trans->email = $user->email;
        $trans->amount = $subscription->price;
        $trans->type = "Subscription";
        $trans->profit = "plus";
        $trans->txnid = $subscription->subscription_number;
        $trans->user_id = $user->id;
        $trans->save();
    }

    public function sendMail($subscription){
        if($this->gs->is_smtp == 1)
        {
            $data = [
                'to' => $subscription->user->email,
                'type' => "Invest",
                'cname' => $subscription->user->name,
                'oamount' => $subscription->order_number,
                'aname' => "",
                'aemail' => "",
                'wtitle' => "",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendAutoMail($data);            
        }
        else
        {
           $to = $subscription->user->email;
           $subject = " You Purchase Plan Successfully.";
           $msg = "Hello ".$subscription->user->nam."!\nYou Purchase Plan Successfully.\nThank you.";
           $headers = "From: ".$this->gs->from_name."<".$this->gs->from_email.">";
           mail($to,$subject,$msg,$headers);            
        }
    }


}