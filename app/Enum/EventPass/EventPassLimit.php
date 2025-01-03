<?php
namespace App\Enum\EventPass;

enum EventPassLimit:string{
    case NORMAL='2';
    case VIP='3';
    case PENDING='1';
    case CANCELED='0';
}