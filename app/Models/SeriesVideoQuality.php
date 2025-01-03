<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeriesVideoQuality extends Model
{
    use HasFactory;
    protected $fillable=[
        'series_id',
        'video_quality_id'
    ];
}
