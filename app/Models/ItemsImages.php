<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemsImages extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'item_images';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'item_id',
        'item_picture1',
        'item_picture2',
        'item_picture3',
        'item_picture4',
        'item_picture5',
        'item_picture6',
        
    ];

}
