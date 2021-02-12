<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    protected $table = 'customer_accounts';

    protected $fillable = [
        'customer_id', 'account_id', 'bank_id',
    ];

    public $timestamps = false;

    public function banks(){
        return $this->belongsTo(Bank::class,'bank_id');
    }
}
