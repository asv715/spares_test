<?php

namespace App\DTO\Order;

use App\Http\Requests\Order\GetListRequest;

class GetListDTO
{
    public function __construct(
        public ?string $status = null,
        public ?int $customerId = null,
        public ?string $startDate = null,
        public ?string $finishDate = null,
    ) {}

    public static function fromRequest(GetListRequest $request): static
    {
        return new self(...$request->validated());
    }
}
