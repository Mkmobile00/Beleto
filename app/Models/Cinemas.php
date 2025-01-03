<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinemas extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'status',
        'cinemas_unique_code',
        'image',
        'summary',
        'description',
    ];
    protected $casts=[
        'status'=>\App\Enum\CustomerEnum::class
    ];

    public function city(){
        return $this->hasMany(CinemasCity::class,'cinemas_id','id');
    }

    public function cinemasBranch(){
        return $this->hasMany(CinemasBranch::class,'cinemas_id','id');
    }
}
