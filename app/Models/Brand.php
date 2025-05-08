<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Translatable;
    protected $table = 'brands';
    public $translatedAttributes = ['name'];

    protected $fillable= ['active','photo'];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function getActive()
    {
        return  $activation =($this->active == 0 ? 'Not Active' : 'Active');
    }

    public function getPhotoAttribute($val)
    {
        return ($val !== null) ? asset("images/brands/".$val) : "";
    }
}
