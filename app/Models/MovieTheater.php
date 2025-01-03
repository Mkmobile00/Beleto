<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MovieTheater extends Model
{
    use HasFactory;
    protected $fillable=[
        'theater_unique_id',
        'title',
        'summary',
        'description',
        'status',
        'screen_id',
        'seat_capacity',
        'cinemas_id',
        'cinemas_branch_id',
        'city_id',
        'image'
    ];

    protected $casts=[
        'status'=>\App\Enum\CustomerEnum::class
    ];

    public function cinemas(){
        return $this->hasOne(Cinemas::class,'id','cinemas_id');
    }

    public function cinemasBranch(){
        return $this->hasOne(CinemasBranch::class,'id','cinemas_branch_id');
    }

    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }

    public function slots(): HasMany
    {
        return $this->hasMany(TheaterTimeSlots::class);
    }


}
