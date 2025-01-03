<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPaymentType extends Model
{
    use HasFactory;
    protected $fillable=[
        'subscription_id',
        'payment_type',
        'amount',
        'amount_type'
    ];

    protected $casts=[
        'payment_type'=>\App\Enum\PaymentTypeEnum::class
    ];
}
