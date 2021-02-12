<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = "customers";

    protected $fillable = [
        'id', 'name', 'username', 'password', 'email', 'mobile', 'image', 'status', 'age', 'balance', 'type'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'remember_token', 'password'
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /*
    * getter setter
    */
    public function getImageAttribute($val){
        return ($val !== null) ? asset('assets/admin/images/'.$val) : "";
    }

    /*
     * functions
     */
    public function getstatus(){
        return $this -> status == 1 ? 'active' : 'block';
    }
}
