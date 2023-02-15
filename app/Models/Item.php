<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'business_id',
        'category_id',
        'sub_category_id',
        'brand_id',
        'condition_id',
        'store_id',
        'ship_mode_id',
        'what_are_you_selling',
        'describe_your_items',
        'weight',
        'width',
        'length',
        'height',
        'quantity',
        'address',
        'latitude',
        'longitude',
        'zip_code',
        'pay_shipping',
        'price_type',
        'price',
        'commission_charge',
        'total_amount',
        'delivery_type',
        'sku',
        'status',
        'item_upload_status',
        'stock_plus_or_minus',
    ];

    public function itemImage(){
        
        return $this->hasOne('App\Models\ItemsImages','item_id','id');
    }

    public function category(){
        
        return $this->hasOne('App\Models\Category','id','category_id');
    }

    public function sub_ategory(){
        
        return $this->hasOne('App\Models\Category','id','sub_category_id');
    }
    
    public function brand(){
        
        return $this->hasOne('App\Models\Brand','id','brand_id');
    }
    
    public function condition(){
        
        return $this->hasOne('App\Models\Condition','id','condition_id');
    }

    public function store_details(){
        
        return $this->hasOne('App\Models\Store','id','store_id');
    }

}
