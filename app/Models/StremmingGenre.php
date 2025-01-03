<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StremmingGenre extends Model
{
    use HasFactory;
    protected $fillable=[
        'series_id',
        'genre_id'
    ];
}
