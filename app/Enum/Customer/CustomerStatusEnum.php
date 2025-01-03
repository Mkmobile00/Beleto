<?php
namespace App\Enum\Customer;

enum CustomerStatusEnum:string{
    case ACTIVE='1';
    case INACTIVE='2';
    case BLOCKED='3';
}