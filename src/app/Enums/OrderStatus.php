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

    public function name(): string
{
    return match($this)
    {
        self::NEW => Constants::ORDER_STATUS_NEW,
        self::CONFIRMED => Constants::ORDER_STATUS_CONFIRMED,
        self::PROCESSING => Constants::ORDER_STATUS_PROCESSING,
        self::SHIPPED => Constants::ORDER_STATUS_SHIPPED,
        self::COMPLETED => Constants::ORDER_STATUS_COMPLETED,
    };
}
}
