<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotificationCustomer extends Model
{
    use HasFactory;
    protected $fillable=[
        'notification_id',
        'customer_id'
    ];
}
