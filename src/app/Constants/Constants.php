<?php

namespace App\Constants;

class Constants
{
    const ORDER_STATUS_NEW = 'Новый';
    const ORDER_STATUS_CONFIRMED = 'Подтвержден';
    const ORDER_STATUS_PROCESSING = 'В обработке';
    const ORDER_STATUS_SHIPPED = 'Доставлен';
    const ORDER_STATUS_COMPLETED = 'Выполнен';
    const ORDER_STATUS_CANCELLED = 'Отменен';

    const SKU_VARIANTS = [
        'Красный',
        'Черный',
        'Зеленый',
        'Пластик',
        'Резина',
        'Металл',
        'Оригинал',
        'Реплика',
    ];

    const CATEGORIES = [
        'Двигатель',
        'Ходовая часть',
        'Трансмиссия',
        'Тормозная система',
        'Электрика',
        'Кузов',
    ];

    const PRODUCTS_PER_PAGE = 15;
    const ORDERS_PER_PAGE = 10;
}
