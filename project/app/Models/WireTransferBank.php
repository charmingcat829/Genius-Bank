<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WireTransferBank extends Model
{
    use HasFactory;

    public function currency(){
        return $this->belongsTo(Currency::class)->withDefault();
    }

    public function country(){
        return $this->belongsTo(Country::class)->withDefault();
    }

    public function transfers(){
        return $this->hasMany(WireTransfer::class);
    }
}
