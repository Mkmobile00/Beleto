<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerNotificationList extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'from_model',
        'from_id'
    ];
}
