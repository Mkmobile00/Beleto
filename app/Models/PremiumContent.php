<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumContent extends Model
{
    use HasFactory;
    protected $fillable=[
        'movie_id',
        'type',
        'is_premium',
        'from',
        'to',
        'price',
        'duration'
    ];

    protected $casts=[
        'type'=>\App\Enum\Customer\MovieTypeEnum::class
    ];
}
