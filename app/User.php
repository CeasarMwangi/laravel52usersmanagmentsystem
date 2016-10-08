<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Eloquent;
use DB;
//class User extends Eloquent{}
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //array will only allow elements defined in $fillable to be updated
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //guarded it will prevent anyone from changing values in that column
    //protected $guarded = array('id'); //we don't have to define since we have $fillable above

    public static $rules = array(
        'name' => 'required|min:5',
        'email' => 'required|email'
    );

}