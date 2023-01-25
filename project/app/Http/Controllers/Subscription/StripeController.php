<?php

namespace App\Http\Controllers\Subscription;

use App\Repositories\SubscriptionRepository;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Controller;
use App\Models\Generalsetting;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StripeController extends Controller
{
    public $subscriptionRepositorty;

    public function __construct(SubscriptionRepository $subscriptionRepositorty)
    {
        $data = PaymentGateway::whereKeyword('Stripe')->first();
        $paydata = $data->convertAutoData();

        Config::set('services.stripe.key', $paydata['key']);
        Config::set('services.stripe.secret', $paydata['secret']);

        $this->subscriptionRepositorty = $subscriptionRepositorty;
    }

    public function store(Request $request){
        $settings = Generalsetting::findOrFail(1);
        $item_name = $settings->title." Subscription";
        
        $item_amount = $request->price;
        $item_number = Str::random(4).time();

        $support = ['USD'];
        if(!in_array($request->currency_code,$support)){
            return redirect()->back()->with('warning','Please Select USD Or EUR Currency For Paypal.');
        }

        $validator = Validator::make($request->all(),[
                        'cardNumber' => 'required',
                        'cardCVC' => 'required',
                        'month' => 'required',
                        'year' => 'required',
                    ]);

        if ($validator->passes()) {

            $stripe = Stripe::make(Config::get('services.stripe.secret'));
            try{
                $token = $stripe->tokens()->create([
                    'card' =>[
                            'number' => $request->cardNumber,
                            'exp_month' => $request->month,
                            'exp_year' => $request->year,
                            'cvc' => $request->cardCVC,
                        ],
                    ]);
                if (!isset($token['id'])) {
                    return back()->with('warning','Token Problem With Your Token.');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => $request->currency_code,
                    'amount' => $item_amount,
                    'description' => $item_name,
                    ]);

                if ($charge['status'] == 'succeeded') {
                    $addionalData = ['subscription_number'=>$item_number,'txnid'=>$charge['balance_transaction']];
                    $this->subscriptionRepositorty->order($request,'complete',$addionalData);

                    return redirect()->route('user.dashboard')->with('message','Bank Plan Updated');
                }
                
            }catch (Exception $e){
                return back()->with('warning', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\CardErrorException $e){
                return back()->with('warning', $e->getMessage());
            }catch (\Cartalyst\Stripe\Exception\MissingParameterException $e){
                return back()->with('warning', $e->getMessage());
            }
        }
        return back()->with('warning', 'Please Enter Valid Credit Card Informations.');
    }
}
