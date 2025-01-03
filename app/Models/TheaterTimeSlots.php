<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheaterTimeSlots extends Model
{
    use HasFactory;
    protected $fillable=[
        'start_time',
        'end_time',
        'movie_theater_id',
        'day_of_week'
    ];
}
