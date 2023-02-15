<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUsers extends Model
{
    use HasFactory;
    protected $table = 'business_users';

    public function user()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function store()
    {
        return $this->hasOne('App\Models\Store','user_id','user_id');
    }

    public function items()
    {
        return $this->hasOne('App\Models\Item','user_id','user_id');
    }
}
