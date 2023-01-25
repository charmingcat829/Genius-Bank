<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'min_limit',
        'max_limit',
        'daily_maximum_limit',
        'monthly_maximum_limit',
        'monthly_total_transaction',
        'daily_total_transaction',
        'fixed_charge',
        'percent_charge',
        'processing_time',
        'instruction',
        'required_information',
        'status',
    ];

    public function beneficiaries(){
        return $this->hasMany('App\Models\Beneficiary','other_bank_id');
    }

    public function transfers(){
        return $this->hasMany(BalanceTransfer::class);
    }
}
