<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transactions";
    protected $fillable = [
        'id', 'sender_id' , 'receiver_id', 'amount', 'status', 'details', 'created_at'
    ];
    public $timestamps = false;
    /*
     * functions
     */
    public function getstatus(){
        return $this -> status == 1 ? 'succeed' : 'failed';
    }
    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'receiver_id');
    }
}
