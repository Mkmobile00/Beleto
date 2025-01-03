<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    protected $fillable = [
        'local_level_id', 
        'province_id', 
        'local_id', 
        'local_name', 
        'dist_id', 
        'country_id'
    ];
}
