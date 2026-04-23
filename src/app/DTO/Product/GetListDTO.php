<?php

namespace App\DTO\Product;

use App\Http\Requests\Product\GetListRequest;

class GetListDTO
{
    public function __construct(
        public ?string $category = null,
        public ?string $sku = null,
        public ?int $page = 1,
    ) {}

    public static function fromRequest(GetListRequest $request): static
    {
        return new self(...$request->validated());
    }
}
