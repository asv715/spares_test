<?php

namespace App\Enums;

use App\Constants\Constants;

enum OrderStatus: string
{
    case NEW = 'new';
    case CONFIRMED = 'confirmed';
    case PROCESSING = 'processing';
    case SHIPPED = 'shipped';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function name(): string
    {
        return match($this)
        {
            self::NEW => Constants::ORDER_STATUS_NEW,
            self::CONFIRMED => Constants::ORDER_STATUS_CONFIRMED,
            self::PROCESSING => Constants::ORDER_STATUS_PROCESSING,
            self::SHIPPED => Constants::ORDER_STATUS_SHIPPED,
            self::COMPLETED => Constants::ORDER_STATUS_COMPLETED,
            self::CANCELLED => Constants::ORDER_STATUS_CANCELLED,
        };
    }

    public function canChangeTo(OrderStatus $nextStatus): bool
    {
        $possibleSwitch = [
            self::NEW->value => [self::CONFIRMED, self::CANCELLED],
            self::CONFIRMED->value => [self::PROCESSING, self::CANCELLED],
            self::PROCESSING->value => [self::SHIPPED],
            self::SHIPPED->value => [self::COMPLETED],
        ];

        return in_arraY($nextStatus, $possibleSwitch[$this->value]);
    }
}
