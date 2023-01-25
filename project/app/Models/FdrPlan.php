<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdrPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'min_amount',
        'max_amount',
        'interest_interval',
        'interval_type',
        'interest_rate',
        'matured_days',
        'status'
    ];

    public function loans(){
        return $this->hasMany(UserFdr::class);
    }
}
