<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BankPlan;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['packages'] = BankPlan::all();
        return view('user.package.index',$data);
    }

    public function subscription($id){
        $data['data'] = BankPlan::findOrFail($id);
        $data['availableGatways'] = ['flutterwave','authorize.net','razorpay','mollie','paytm','instamojo','stripe','paypal'];
        $data['gateways'] = PaymentGateway::OrderBy('id','desc')->whereStatus(1)->get();
        return view('user.package.details',$data);
    }
}
