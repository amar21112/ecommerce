<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $guarded = []; // all columns fillable
//    protected $fillable = ['name','email','password' ,'created_at','updated_at'];
//    protected $hidden = ['password','created_at','updated_at'];

    public $timestamps = true;
}
