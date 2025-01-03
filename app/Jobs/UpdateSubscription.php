<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use App\Models\SubscriptionPayment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateSubscription
{
   

   public function __invoke()
   {
        $this->updateSubscription();
   }

   public function updateSubscription(){
        $allSubscription=SubscriptionPayment::get();
        $currentDate=Carbon::now()->format('Y-m-d');
        foreach($allSubscription as $subscription){
            $toDate=$subscription->to_date;
            if($currentDate > $toDate){
                $subscription->is_expired='1';
                $subscription->save();
            }
        }
   }
}
