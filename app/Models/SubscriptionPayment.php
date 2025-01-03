<?php

namespace App\Models;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionPayment extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'subscription_id',
        'payment_type',
        'payment_status',
        'amount',
        'transaction_id',
        'is_expired',
        'purchase_date',
        'from_date',
        'to_date',
        'amount_type',
        'payment_code',
        'payment_from'
    ];

    protected $casts=[
        'payment_status'=>\App\Enum\PaymentStatusEnum::class
    ];

    public function subscription(){
        return $this->hasOne(Subscription::class,'id','subscription_id');
    }
    public function customer(){
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
