<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';
    protected $guarded = []; // all columns fillable
//    protected $fillable = ['name','email','password' ,'created_at','updated_at'];
//    protected $hidden = ['password','created_at','updated_at'];

    public $timestamps = true;
}
