<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'other_bank_id',
        'account_number',
        'account_name',
        'nick_name',
        'details'
    ];

    public function bank(){
        return $this->belongsTo('App\Models\OtherBank','other_bank_id')->withDefault();
    }

    public function transfers(){
        return $this->hasMany(BalanceTransfer::class);
    }
    
}
