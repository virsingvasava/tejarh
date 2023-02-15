<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoostItem extends Model
{
    use HasFactory;
    protected $table = 'boost_items';

    public function items()
    {
        return $this->hasOne('App\Models\Item','user_id','user_id');
    }
    public function itemImage(){
        
        return $this->hasOne('App\Models\ItemsImages','item_id','id');
    }
}
