<?php

namespace App\Constants;

enum CategoryName: string
{
    case BASIC = 'basic';
    case INVOICING = 'invoicing';
    case SUBSCRIPTIONS = 'subscriptions';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function text(): string
    {
        return match ($this) {
            self::BASIC => trans('categories.basic'),
            self::INVOICING => trans('categories.invoicing'),
            self::SUBSCRIPTIONS => trans('categories.subscriptions'),
        };
    }
}
