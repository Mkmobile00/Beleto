<?php
namespace App\Enum;

enum PaymentTypeEnum:string{
    case ESEWA='1';
    case KHALTI='2';
    case PRABHUPAY='6';
    case IMEPAY='4';
    case PAYPAL='5';
    case HAMROPAY='3';
    case BANK='7';
    case CASH='8';
}