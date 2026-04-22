<?php

namespace App\Constants;

class Constants
{
    const ORDER_STATUS_NEW = 'Новый';
    const ORDER_STATUS_CONFIRMED = 'Подтвержден';
    const ORDER_STATUS_PROCESSING = 'В обработке';
    const ORDER_STATUS_SHIPPED = 'Доставлен';
    const ORDER_STATUS_COMPLETED = 'Выполнен';

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
}
