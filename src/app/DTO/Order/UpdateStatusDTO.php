<?php

namespace App\DTO\Order;

use App\Http\Requests\Order\UpdateStatusRequest;
use App\Enums\OrderStatus;

class UpdateStatusDTO
{
    public function __construct(
        public OrderStatus $status,
    ) {}

    public static function fromRequest(UpdateStatusRequest $request): static
    {
        $data = $request->validated();

        return new self(OrderStatus::tryFrom($data['status']) ?? OrderStatus::NEW);
    }
}
