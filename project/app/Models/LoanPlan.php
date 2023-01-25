<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'min_amount',
        'max_amount',
        'per_installment',
        'installment_interval',
        'total_installment',
        'instruction',
        'required_information',
        'status',
    ];

    public function loans(){
        return $this->hasMany(UserLoan::class);
    }
}
