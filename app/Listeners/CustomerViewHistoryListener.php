<?php

namespace App\Listeners;

use App\Events\CustomerViewHistoryEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CustomerViewHistoryListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CustomerViewHistoryEvent $event): void
    {
        //
    }
}