<?php
namespace App\Enum\Customer;

enum LoginTypeEnum:string{
    case SYSTEM='1';
    case GOOGLE='2';
    case APPLE='3';
}