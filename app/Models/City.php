<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'status',
        'slug'
    ];

    protected $casts=[
        'status'=>\App\Enum\CustomerEnum::class
    ];
}
