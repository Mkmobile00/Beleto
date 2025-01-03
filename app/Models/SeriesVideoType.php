<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesVideoType extends Model
{
    use HasFactory;
    protected $fillable=[
        'series_id',
        'video_type_id'
    ];
}
