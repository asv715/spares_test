<?php

namespace App\DTO\Order;

use App\Http\Requests\Order\CreateRequest;

class CreateDTO
{
    public function __construct(
        public int $customerId,
        public array $items,
    ) {}

    public static function fromRequest(CreateRequest $request): static
    {
        return new self(...$request->validated());
    }
}
