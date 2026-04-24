<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->name(),
            'totalAmount' => $this->total_amount,
            'createdAt' => $this->created_at,
            'confirmedAt' => $this->confirmed_at,
            'shippedAt' => $this->shipped_at,
            'customer' => $this->customer,
            'items' => OrderItemCollectionResource::make($this->items)
        ];
    }
}
