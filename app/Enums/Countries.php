<?php

namespace App\Enums;

enum Countries: string
{
    case GB = 'GB';
    case US = 'US';

    public function label(): string
    {
        return match ($this) {
            Countries::GB => '🇬🇧 United Kingdom',
            Countries::US => '🇺🇸 United States',
        };
    }
}
