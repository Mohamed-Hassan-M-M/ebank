<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
        'password', 'bank_id', 'balance',
    ];

    public $timestamp = false;

    public function banks(){
        return $this->belongsTo(Bank::class,'bank_id');
    }
}
