<?php

namespace App\Services\Product;

use App\Constants\Constants;
use App\DTO\Product\GetListDTO;
use App\Models\Product;

class ProductService
{
    public function getList(GetListDTO $getListDTO): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Product::query()
            ->when($getListDTO->category, function($query) use($getListDTO) {
                $query->where('category', $getListDTO->category);
            })
            ->when($getListDTO->sku, function($query) use($getListDTO) {
                $query->where('sku', $getListDTO->sku);
            })
            ->paginate(Constants::PRODUCTS_PER_PAGE);
    }
}
