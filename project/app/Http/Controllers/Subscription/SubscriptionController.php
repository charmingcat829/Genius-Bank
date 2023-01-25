<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Models\BankPlan;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request){
        $user = User::findorFail(auth()->id());
        if($user){
            $bankplan = BankPlan::whereId($request->bank_plan_id)->first();
            $user->bank_plan_id = $bankplan->id;
            $user->plan_end_date = now()->addDays($bankplan->days);
            $user->update();
        }
        return redirect()->route('user.dashboard')->with('message','Bank Plan Updated');
    }
}
