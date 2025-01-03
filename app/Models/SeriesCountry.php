<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesCountry extends Model
{
    use HasFactory;
    protected $fillable=[
        'series_id',
        'country_id'
    ];
}
