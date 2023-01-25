<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = ['name', 'sign', 'value'];
    public $timestamps = false;

    public function wiretransfers(){
        return $this->hasMany(WireTransferBank::class);
    }
}
