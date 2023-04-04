<?php

declare(strict_types=1);

namespace App\Enum;

use OpenApi\Attributes\Schema;

// #[Schema]
enum CardTypesEnum: string
{
    case DISCOUNT = 'discount';
    case GIFT = 'gift';
    case CASHBACK = 'cashback';
    case SUBSCRIPTION = 'subscription';

    /**
     * @return string[]
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
