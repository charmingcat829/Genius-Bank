<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDps extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_no',
        'user_id',
        'dps_plan_id',
        'per_installment',
        'installment_interval',
        'total_installment',
        'given_installment',
        'deposit_amount',
        'matured_amount',
        'interest_rate',
        'status',
        'is_given',
    ];

    protected $dates = [
        'next_installment',
    ];

    public function plan(){
        return $this->belongsTo(DpsPlan::class,'dps_plan_id')->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
