<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartUpAdd extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'description',
        'image',
        'from_date',
        'to_date',
        'status'
    ];

    protected $casts=[
        'status'=>\App\Enum\Customer\CustomerStatusEnum::class
    ];
}
