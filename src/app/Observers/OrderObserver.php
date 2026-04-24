<?php

namespace App\Observers;

use App\Events\OrderConfirmed;
use App\Models\Order;
use App\Enums\OrderStatus;

class OrderObserver
{
    public function updated(Order $order): void
    {
        if ($order->isDirty(['status'])) {
            if ($order->status === OrderStatus::CONFIRMED) {
                OrderConfirmed::dispatch($order);
            }
        }
    }
}
