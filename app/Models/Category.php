<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Category extends Model
{
    use Translatable;
    protected $table = 'categories';

    protected $with = ['translations'];
    protected $translatedAttributes = ['name'];
    protected $fillable = ['parent_id', 'slug', 'is_active'];
    protected $hidden = ['translations'];
    protected $casts = [
        'is_active' => 'boolean'
    ];
    public $timestamps = true;

    public function scopeParent($query){
        return $query->whereNull('parent_id');
    }

    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }
    public function scopeActive($query){
        return $query->where('is_active',1);
    }
    public function getActive()
    {
      return  $activation =($this->is_active == 0 ? 'Not Active' : 'Active');
    }

    public function parentCategory(){
        return $this->belongsTo(self::class, 'parent_id');
    }


}
