<?php
namespace App\Actions\Customer;

class NotificationArray{
    function __construct(
        public int $customer_id,
        public string $from_model,
        public int $from_id,
    ){

    }
    public function getData()
    {
        return collect($this)->toArray();
    }
}