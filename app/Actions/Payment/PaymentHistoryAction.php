<?php
namespace App\Actions\Payment;

class PaymentHistoryAction{

    function __construct(
        public int $customer_id,
        public string $from_model,
        public int $model_id,
        public string $transaction_id,
        public string $purpose,
        public float $amount,
        public string $amount_type,
        public int $payment_type,
        public string $remarks
    ){

    }
    public function getData()
    {
        return collect($this)->toArray();
    }
}