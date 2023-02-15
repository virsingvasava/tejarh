<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    public function sub_category()
    {
        return $this->hasOne('App\Models\SubCategory','category_id','id');
    }
    public function my_subcategory()
    {
        return $this->hasMany('App\Models\SubCategory','category_id','id');
    }

}
