<?php

namespace App\Http\Controllers;

use App\DTO\Product\GetListDTO;
use App\Http\Requests\Product\GetListRequest;
use App\Http\Resources\Product\ProductCollectionResource;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function getList(GetListRequest $request)
    {
        $dto = GetListDTO::fromRequest($request);

        $products = $this->service->getList($dto);

        return new ProductCollectionResource($products);
    }
}
