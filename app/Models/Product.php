<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        'brand_id',
        'name',
        'size',
        'selling_description',
        'product_description',
        'weight',
        'condition',
        'quantity',
        'zip_code',
        'ship_mode',
        'pay_shipping',
        'price_type',
        'price',
        'status',
        'import_data_status'
    ];

    public function productImage(){
        
        return $this->hasMany('App\Models\ItemPostImage','product_id','id');
    }

    public function business_user(){
        
        return $this->hasMany('App\Models\User','id','user_id');
    }

    public function category(){
        
        return $this->hasMany('App\Models\Category','id','category_id');
    }

    public function sub_ategory(){
        
        return $this->hasMany('App\Models\Category','id','sub_category_id');
    }
    
    public function brand(){
        
        return $this->hasMany('App\Models\Brand','id','brand_id');
    }
    
    public function condition(){
        
        return $this->hasMany('App\Models\Condition','id','condition_id');
    }

    public function store_details(){
        
        return $this->hasMany('App\Models\Store','id','store_id');
    }
    
    public function item_pictures()
    {
        return $this->hasOne('App\Models\ProductImage','product_id','id');
    }

}
