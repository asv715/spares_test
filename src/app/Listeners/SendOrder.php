<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use App\Jobs\ExportOrderJob;

class SendOrder
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
    public function handle(OrderConfirmed $event): void
    {
        ExportOrderJob::dispatch($event->order);
    }
}
