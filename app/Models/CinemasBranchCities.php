<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CinemasBranchCities extends Model
{
    use HasFactory;
    protected $fillable=[
        'cinemas_branch_id',
        'city_id'
    ];
}
