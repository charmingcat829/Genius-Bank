<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WireTransfer extends Model
{
    use HasFactory;
    protected $guarded = ['*'];

    public function bank(){
        return $this->belongsTo(WireTransferBank::class,'wire_transfer_bank_id')->withDefault();
    }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
