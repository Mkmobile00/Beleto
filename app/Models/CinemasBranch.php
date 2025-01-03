<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemasBranch extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'branch_id',
        'summary',
        'description',
        'cinemas_id',
        'status',
        'image'
    ];
    protected $casts=[
        'status'=>\App\Enum\CustomerEnum::class
    ];

    public function cities(){
        return $this->hasMany(CinemasBranchCities::class,'cinemas_branch_id','id');
    }

    public function cinemas(){
        return $this->hasOne(Cinemas::class,'id','cinemas_id');
    }

}

