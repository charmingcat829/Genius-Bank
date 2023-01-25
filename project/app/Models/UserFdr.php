<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFdr extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_no',
        'user_id',
        'fdr_plan_id',
        'amount',
        'profit_type',
        'profit_amount',
        'interest_rate',
        'status',
    ];

    protected $dates = [
        'next_profit_time',
        'matured_time',
    ];

    public function plan(){
        return $this->belongsTo(FdrPlan::class,'fdr_plan_id')->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
