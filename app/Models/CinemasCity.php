<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemasCity extends Model
{
    use HasFactory;
    protected $fillable=[
        'cinemas_id',
        'city_id'
    ];
}
