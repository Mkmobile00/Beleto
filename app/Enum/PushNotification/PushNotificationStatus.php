<?php
namespace App\Enum\PushNotification;

enum PushNotificationStatus:string{
    case PUSHED='1';
    case UNPUSHED='2';
    case DRAFT='3';
}