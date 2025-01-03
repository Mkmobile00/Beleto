<?php

namespace App\Models;

use App\Models\Customer\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $fillable=[
        'customer_id',
        'from_model',
        'model_id',
        'transaction_id',
        'purpose',
        'amount',
        'amount_type',
        'payment_type',
        'remarks'
    ];

    protected $casts=[
        'payment_type'=>\App\Enum\PaymentTypeEnum::class
    ];

    public function customer(){
        // dd('ok');
        return $this->hasOne(Customer::class,'id','customer_id');
    }
}
