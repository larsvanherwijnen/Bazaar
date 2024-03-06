<?php

namespace App\Enum;

enum RolesEnum: int
{
    case PRIVATE_WITHOUT_ADVERTISING = 0;
    case PRIVATE_WITH_ADVERTISING = 1;
    case BUSINESS = 2;


    public function isPrivateWithoutAdvertising(): bool
    {
        return $this === self::PRIVATE_WITHOUT_ADVERTISING;
    }

    public function isPrivateWithAdvertising(): bool
    {
        return $this === self::PRIVATE_WITH_ADVERTISING;
    }

    public function isBusiness(): bool
    {
        return $this === self::BUSINESS;
    }


    public static function fromString(string $value): self
    {
        return match ($value) {
            'private_without_advertising' => self::PRIVATE_WITHOUT_ADVERTISING,
            'private_with_advertising' => self::PRIVATE_WITH_ADVERTISING,
            'business' => self::BUSINESS,
        };
    }
}
