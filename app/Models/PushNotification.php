<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'slug',
        'image',
        'summary',
        'description',
        'status',
        'for',
        'pushed_date',
        'url',
    ];

    protected $casts=[
        'status'=>\App\Enum\PushNotification\PushNotificationStatus::class,
        'for'=>\App\Enum\PushNotification\NotificationUserType::class
    ];

    public function customer(){
        return $this->hasMany(PushNotificationCustomer::class,'notification_id','id');
    }
}
