<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowDates extends Model
{
    use HasFactory;
    protected $fillable=[
        'show_id',
        'date',
    ];

    public function timeSlot(){
        return $this->hasMany(ShowDatesTimeSlot::class,'show_date_id','id');
    }
}
