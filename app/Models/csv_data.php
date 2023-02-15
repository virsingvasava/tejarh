<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class csv_data extends Model
{
    use HasFactory;
    protected $table = 'csv_datas';
    protected $fillable = ['user_id','csv_filename', 'csv_header', 'csv_data'];
}
