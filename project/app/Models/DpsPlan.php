<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'per_installment',
        'installment_interval',
        'total_installment',
        'interest_rate',
        'final_amount',
        'user_profit',
        'status',
    ];

    public function dps(){
        return $this->hasMany(UserDps::class);
    }
}
