<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowDatesTimeSlot extends Model
{
    use HasFactory;
    protected $fillable=[
        'show_date_id',
        'start_time',
        'end_time'
    ];
}
