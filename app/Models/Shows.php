<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shows extends Model
{
    use HasFactory;
    protected $fillable=[
        'movies_id',
        'title',
        'status',
        'summary',
        'description',
        'image',
        'theater_id'
    ];
    protected $casts=[
        'status'=>\App\Enum\UserStatusEnum::class
    ];

    public function theater(){
        return $this->hasOne(MovieTheater::class,'id','theater_id');
    }

    public function movie(){
        return $this->hasOne(Movie::class,'id','movies_id');
    }

    public function showDates(){
        return $this->hasMany(ShowDates::class,'show_id','id');
    }
}
