<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    protected $table = "admins";

    protected $fillable = [
        'id', 'name', 'username', 'password', 'email', 'mobile', 'image', 'status', 'super_admin', 'type'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'remember_token',
    ];
    /*
    * getter setter
    */
    public function getImageAttribute($val){
        return ($val !== null) ? asset('assets/images/'.$val) : "";
    }
    public function setPasswordAttribute($pass){
        if(!empty($pass))
            $this->attributes['password'] = bcrypt($pass);
    }
    /*
     * functions
     */
    public function getstatus(){
        return $this -> status == 1 ? 'active' : 'not active';
    }
}
