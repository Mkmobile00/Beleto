<?php
namespace App\Enum;

enum PaymentStatusEnum:string{
    case SUCCESS='1';
    case PENDING='2';
    case CANCELLED='3';
}