<?php

namespace App\Http\Controllers\Subscription;

use App\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    private $subscriptionRepositorty;

    public function __construct(SubscriptionRepository $subscriptionRepositorty)
    {
        $data = PaymentGateway::whereKeyword('razorpay')->first();
        $paydata = $data->convertAutoData();
        $this->keyId = $paydata['key'];
        $this->keySecret = $paydata['secret'];
        $this->displayCurrency = 'INR';
        $this->api = new Api($this->keyId, $this->keySecret);

        $this->subscriptionRepositorty = $subscriptionRepositorty;
    }

    public function store(Request $request)
    {
        if($request->currency_code != "INR")
        {
            return redirect()->back()->with('warning','Please Select INR Currency For Rezorpay.');
        }
        
        $settings = Generalsetting::findOrFail(1);

        $input = $request->all();

        $item_name = $settings->title." Subscription";
        $item_amount = $request->price;
        $item_number = Str::random(4).time();

        $order['item_name'] = $settings->title." Order";
        $order['item_number'] = Str::random(4).time();
        $order['item_amount'] = round($item_amount,2);

        $cancel_url = route('user.package.index');
        $notify_url = route('subscription.razorpay.notify');


        $orderData = [
            'receipt'         => $order['item_number'],
            'amount'          => $order['item_amount'] * 100,
            'currency'        => 'INR',
            'payment_capture' => 1
        ];
        
        $razorpayOrder = $this->api->order->create($orderData);

        $input['user_id'] = auth()->user()->id;
        
        Session::put('input_data',$input);
        Session::put('order_data',$order);
        Session::put('order_payment_id', $razorpayOrder['id']);

        $displayAmount = $amount = $orderData['amount'];
                    
        if ($this->displayCurrency !== 'INR')
        {
            $url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);
        
            $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
        }
        
        $checkout = 'automatic';
        
        if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
        {
            $checkout = $_GET['checkout'];
        }
        
        $data = [
            "key"               => $this->keyId,
            "amount"            => $amount,
            "name"              => $order['item_name'],
            "description"       => $order['item_name'],
            "prefill"           => [
                "name"              => $request->customer_name,
                "email"             => $request->customer_email,
                "contact"           => $request->customer_phone,
            ],
            "notes"             => [
                "address"           => $request->customer_address,
                "merchant_order_id" => $order['item_number'],
            ],
            "theme"             => [
                "color"             => "{{$settings->colors}}"
            ],
            "order_id"          => $razorpayOrder['id'],
        ];
        
        if ($this->displayCurrency !== 'INR')
        {
            $data['display_currency']  = $this->displayCurrency;
            $data['display_amount']    = $displayAmount;
        }
        
        $json = json_encode($data);
        $displayCurrency = $this->displayCurrency;
        
        return view( 'frontend.razorpay-checkout', compact( 'data','displayCurrency','json','notify_url' ) );
    }

    public function notify(Request $request)
    {
        $input_data = $request->all();
        $payment_id = Session::get('order_payment_id');
        $orderData = Session::get('order_data');

        $success = true;

        if (empty($input_data['razorpay_payment_id']) === false)
        {
        
            try
            {
                $attributes = array(
                    'razorpay_order_id' => $payment_id,
                    'razorpay_payment_id' => $input_data['razorpay_payment_id'],
                    'razorpay_signature' => $input_data['razorpay_signature']
                );
        
                $this->api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
            }
        }

        if ($success === true){
            $addionalData = ['txnid'=>$payment_id,'subscription_number'=>$orderData['item_number']];
            $this->subscriptionRepositorty->OrderFromSession($request,'complete',$addionalData);

            return redirect()->route('user.dashboard')->with('message','Bank Plan Updated');
            
        }
        return redirect()->route('user.package.index')->with('warning','Something went wrong!');
    }
}
