<?php

namespace App\Http\Controllers\Subscription;

use App\Repositories\SubscriptionRepository;
use App\Http\Controllers\Controller;
use App\Models\PaymentGateway;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class FlutterwaveController extends Controller
{
    private $public_key;
    private $secret_key;
    private $subscriptionRepositorty;

    public function __construct(SubscriptionRepository $subscriptionRepositorty)
    {
        $data = PaymentGateway::whereKeyword('flutterwave')->first();
        $paydata = $data->convertAutoData();
        $this->public_key = $paydata['public_key'];
        $this->secret_key = $paydata['secret_key'];
        $this->subscriptionRepositorty = $subscriptionRepositorty;
    }

    public function store(Request $request) {
          $support = [
            'BIF',
            'CAD',
            'CDF',
            'CVE',
            'EUR',
            'GBP',
            'GHS',
            'GMD',
            'GNF',
            'KES',
            'LRD',
            'MWK',
            'NGN',
            'RWF',
            'SLL',
            'STD',
            'TZS',
            'UGX',
            'USD',
            'XAF',
            'XOF',
            'ZMK',
            'ZMW',
            'ZWD'
        ];
        if(!in_array($request->currency_code,$support)){
          return redirect()->back()->with('warning','Please Select USD Or EUR Currency For Paypal.');
        }
        $item_number = Str::random(4).time();
        $item_amount = $request->price;

        $curl = curl_init();

        $customer_email =  auth()->user()->email;
        $amount = $item_amount;  
        $currency = $request->currency_code;
        $txref = $item_number;
        $PBFPubKey = $this->public_key;
        $redirect_url = route('subscription.flutter.notify');
        $payment_plan = "";

        $addionalData = ['subscription_number'=>$item_number];
        $this->subscriptionRepositorty->order($request,'pending',$addionalData);

        Session::put('order_number',$item_number);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode([
              'amount' => $amount,
              'customer_email' => $customer_email,
              'currency' => $currency,
              'txref' => $txref,
              'PBFPubKey' => $PBFPubKey,
              'redirect_url' => $redirect_url,
              'payment_plan' => $payment_plan
            ]),
            CURLOPT_HTTPHEADER => [
              "content-type: application/json",
              "cache-control: no-cache"
            ],
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          if($err){
            die('Curl returned error: ' . $err);
          }
          
          $transaction = json_decode($response);
          
          if(!$transaction->data && !$transaction->data->link){
            print_r('API returned error: ' . $transaction->message);
          }
          
          return redirect($transaction->data->link);

     }


     public function notify(Request $request) {

        $input = $request->all();
        $order_number = Session::get('order_number');
 
        $subscription = UserSubscription::where('subscription_number',$order_number)->where('status','pending')->first();

        if($request->cancelled == "true"){
          return redirect()->route('user.dashboard')->with('success',__('Payment Cancelled!'));
        }


        if (isset($input['txref'])) {
            $ref = $input['txref'];
            $query = array(
                "SECKEY" => $this->secret_key,
                "txref" => $ref
            );

            $data_string = json_encode($query);
              
            $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
            $response = curl_exec($ch);
            curl_close($ch);
            $resp = json_decode($response, true);

            if ($resp['status'] == "success") {

              $paymentStatus = $resp['data']['status'];
              $chargeResponsecode = $resp['data']['chargecode'];

              if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($paymentStatus == "successful")) {
      
                  $subscription->status = "completed";
                  $subscription->txnid = $resp['data']['txid'];
                  $subscription->update();

                  $this->subscriptionRepositorty->callAfterOrder($request,$subscription);

                  return redirect()->route('user.dashboard')->with('message','Bank Plan Updated');
              
              }
              else {
                return redirect()->route('user.package.index')->with('error','Something went wrong!');
              }

            }
        }
        else {
            return redirect()->route('user.package.index')->with('error','Something went wrong!');
          }

     }
}
