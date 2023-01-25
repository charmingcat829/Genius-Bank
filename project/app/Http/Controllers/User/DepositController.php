<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\PaymentGateway;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data['deposits'] = Deposit::orderby('id','desc')->whereUserId(auth()->id())->paginate(10);
        return view('user.deposit.index',$data);
    }

    public function create(){
        $data['availableGatways'] = ['flutterwave','authorize.net','razorpay','mollie','paytm','instamojo','stripe','paypal','paystack'];
        $data['gateways'] = PaymentGateway::OrderBy('id','desc')->whereStatus(1)->get();
        
        return view('user.deposit.create',$data);
    }
}
