<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_no',
        'user_id',
        'plan_id',
        'loan_amount',
        'per_installment_amount',
        'total_installment',
        'given_installment',
        'paid_amount',
        'total_amount',
        'required_information',
    ];
    
    protected $dates = [
        'next_installment',
    ];

    public function plan(){
        return $this->belongsTo(LoanPlan::class)->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
