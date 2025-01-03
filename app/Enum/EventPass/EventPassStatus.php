<?php
namespace App\Enum\EventPass;

enum EventPassStatus:string{
    case INACTIVE='1';
    case ACTIVE='2';
    case BLOCKED='3';
}