<?php

namespace App\Services\Order;

use App\Constants\Constants;
use App\Constants\Messages;
use App\DTO\Order\CreateDTO;
use App\DTO\Order\GetListDTO;
use App\DTO\Order\UpdateStatusDTO;
use App\Exceptions\IncorrectStatusChangeException;
use App\Exceptions\NotEnoughOnStockException;
use App\Exceptions\ProductCountMismatchException;
use App\Models\Order;
use App\Models\Product;
use App\Enums\OrderStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function getList(GetListDTO $getListDTO): \Illuminate\Pagination\LengthAwarePaginator
    {
        return Order::query()
            ->when($getListDTO->status, function($query) use($getListDTO) {
                $query->where('status', $getListDTO->status);
            })
            ->when($getListDTO->customerId, function($query) use($getListDTO) {
                $query->where('customerId', $getListDTO->customerId);
            })
            ->when($getListDTO->startDate, function($query) use($getListDTO) {
                $query->where('created_at', '>=', $getListDTO->startDate);
            })
            ->when($getListDTO->finishDate, function($query) use($getListDTO) {
                $query->where('created_at', '<=', $getListDTO->finishDate);
            })
            ->paginate(Constants::ORDERS_PER_PAGE);
    }

    /**
     * @throws NotEnoughOnStockException
     * @throws ProductCountMismatchException
     */
    public function create(CreateDTO $createDTO): ?Order
    {
        $newOrder = null;

        $itemsInOrder = Product::ofId(array_column($createDTO->items, 'productId'))->get();
        $quantitiesById = collect($createDTO->items)->mapWithKeys(function($item) {
            return [$item['productId'] => $item['quantity']];
        });

        if ($itemsInOrder->count() !== count($createDTO->items)) {
            throw new ProductCountMismatchException(Messages::ERROR_ORDER_PRODUCT_COUNT_MISMATCH, 422);
        }

        if (!$this->areItemsEnoughOnStock($itemsInOrder, $quantitiesById)) {
            throw new NotEnoughOnStockException(Messages::ERROR_PRODUCT_COUNT_NOT_ENOUGH, 422);
        }

        DB::transaction(function() use($createDTO, $itemsInOrder, &$newOrder, $quantitiesById) {
            $newOrder = Order::create([
                'customer_id' => $createDTO->customerId,
                'total_amount' => collect($createDTO->items)->sum('quantity'),
                'status' => OrderStatus::NEW
            ]);
            $items = $itemsInOrder->map(function($item) use($quantitiesById) {
                return [
                    'product_id' => $item->id,
                    'quantity' => $quantitiesById[$item->id],
                    'unit_price' => $item->price,
                    'total_price' => $quantitiesById[$item->id] * $item->price
                ];
            });

            $newOrder->items()->createMany($items);

            $this->decreaseQuantity($itemsInOrder, $quantitiesById);
        });

        return $newOrder;
    }

    private function areItemsEnoughOnStock(Collection $items, \Illuminate\Support\Collection $quantitiesById): bool
    {
        return $items->every(fn($item) => $item->stock_quantity >= $quantitiesById[$item->id]);
    }

    private function decreaseQuantity(Collection $items, \Illuminate\Support\Collection $quantitiesById): void
    {
        foreach($items as $item) {
            $item->update([
                'stock_quantity' => $item->stock_quantity - $quantitiesById[$item->id]
            ]);
        }
    }

    /**
     * @throws IncorrectStatusChangeException
     */
    public function updateStatus(Order $order, UpdateStatusDTO $updateStatusDTO): void
    {
        $dataToUpdate = [
            'status' => $updateStatusDTO->status
        ];

        if (!$order->status->canChangeTo($updateStatusDTO->status)) {
            throw new IncorrectStatusChangeException(Messages::ERROR_INCORRECT_STATUS_CHANGE, 422);
        }

        if ($updateStatusDTO->status === OrderStatus::CONFIRMED) {
            $dataToUpdate['confirmed_at'] = Carbon::now()->format('Y-m-d H:i:s');
        } elseif ($updateStatusDTO->status === OrderStatus::SHIPPED) {
            $dataToUpdate['shipped_at'] = Carbon::now()->format('Y-m-d H:i:s');
        }

        $order->update($dataToUpdate);
    }
}
