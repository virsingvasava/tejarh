<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stories extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function category()
    {
        return $this->hasOne('App\Models\Category','id','category_id');
    }
}
