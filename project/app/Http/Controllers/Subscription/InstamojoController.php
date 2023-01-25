<?php

namespace App\Http\Controllers\Subscription;

use App\Repositories\SubscriptionRepository;
use App\Http\Controllers\Controller;
use App\Classes\Instamojo;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class InstamojoController extends Controller
{
    public $subscriptionRepositorty;

    public function __construct(SubscriptionRepository $subscriptionRepositorty)
    {
        $this->subscriptionRepositorty = $subscriptionRepositorty;
    }

    public function store(Request $request)
    {
        if($request->currency_code != "INR")
        {
            return redirect()->back()->with('warning','Please Select INR Currency For Paytm.');
        }
        
        $input = $request->all();
        $data = PaymentGateway::whereKeyword('instamojo')->first();
        $gs = Generalsetting::first();
        $total =  $request->price;
        $paydata = $data->convertAutoData();
        

        $order['item_name'] = $gs->title." Subscription";
        $order['item_number'] = Str::random(4).time();
        $order['item_amount'] = $total;

        $cancel_url = route('payment.cancle');
        $notify_url = route('subscription.instamojo.notify');

        if($paydata['sandbox_check'] == 1){
        $api = new Instamojo($paydata['key'], $paydata['token'], 'https://test.instamojo.com/api/1.1/');
        }
        else {
        $api = new Instamojo($paydata['key'], $paydata['token']);
        }

        try {
            $response = $api->paymentRequestCreate(array(
                "purpose" => $order['item_name'],
                "amount" => $order['item_amount'],
                "send_email" => true,
                "email" => auth()->user()->email,
                "redirect_url" => $notify_url
            ));
            $redirect_url = $response['longurl'];

        Session::put('input_data',$input);
        Session::put('order_data',$order);
        Session::put('order_payment_id', $response['id']);

        return redirect($redirect_url);

        }
        catch (Exception $e) {
            return redirect($cancel_url)->with('unsuccess','Error: ' . $e->getMessage());
        }
    }

    public function notify(Request $request)
    {
        $input_data = $request->all();
        $item_number = Str::random(4).time();
        $payment_id = Session::get('order_payment_id');

        if($input_data['payment_status'] == 'Failed'){
            return redirect()->route('user.package.index')->with('error','Something went wrong!');
        }

        if ($input_data['payment_request_id'] == $payment_id) {

            $addionalData = ['txnid'=>$payment_id,'subscription_number'=>$item_number];
            $this->subscriptionRepositorty->OrderFromSession($request,'complete',$addionalData);

            return redirect()->route('user.dashboard')->with('message','Bank Plan Updated');

        }
        return redirect()->route('user.package.index')->with('error','Something went wrong!');
    }
}
