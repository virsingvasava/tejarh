<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{
    use HasFactory;
    protected $table = 'customer_supports';

    public function users_names()
    {
        return $this->hasOne('App\Models\Users','id','user_id');
    }

}
