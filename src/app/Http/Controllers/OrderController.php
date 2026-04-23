<?php

namespace App\Http\Controllers;

use App\DTO\Order\CreateDTO;
use App\DTO\Order\GetListDTO;
use App\DTO\Order\UpdateStatusDTO;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\GetListRequest;
use App\Http\Requests\Order\UpdateStatusRequest;
use App\Http\Resources\Order\OrderCollectionResource;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    public function __construct(private OrderService $service) {}

    public function getList(GetListRequest $request)
    {
        $dto = GetListDTO::fromRequest($request);

        $orders = $this->service->getList($dto);

        return new OrderCollectionResource($orders);
    }

    public function getDetail(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * @throws \App\Exceptions\NotEnoughOnStockException
     * @throws \App\Exceptions\ProductCountMismatchException
     */
    public function create(CreateRequest $request)
    {
        $dto = CreateDTO::fromRequest($request);

        $newOrder = $this->service->create($dto);

        return new OrderResource($newOrder);
    }

    /**
     * @throws \App\Exceptions\IncorrectStatusChangeException
     */
    public function updateStatus(Order $order, UpdateStatusRequest $request)
    {
        $dto = UpdateStatusDTO::fromRequest($request);
        $this->service->updateStatus($order, $dto);

        return response()->json([
            'status' => 204
        ]);
    }
}
