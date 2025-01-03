<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'photo',
        'photo_status',
        'photo_from'
    ];

    protected $casts=[
        'gender'=>\App\Enum\GenderEnum::class
    ];
}
