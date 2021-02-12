<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = "banks";

    protected $fillable = [
        'id', 'name', 'mobile', 'website', 'email', 'image', 'status',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
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
        return $this -> status == 1 ? 'active' : 'not active';
    }
}
