<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class User_verificationcode extends Model
{
    use Translatable;
    protected $table = 'user_verificationcodes';
    protected $fillable = ['user_id' , 'code' ];
    public $timestamps = true;

}
