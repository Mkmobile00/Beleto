<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventVisitorTime extends Model
{
    use HasFactory;
    protected $fillable=[
        'event_id',
        'visitor_id',
        'date_time'
    ];
}
