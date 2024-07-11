<?php

namespace App\Constants;

enum Currency: string
{
    case USD = 'USD';
    case COP = 'COP';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
