<?php

namespace App\Enum;

enum RolesEnum: int
{
    case PRIVATE_WITHOUT_ADVERTISING = 0;
    case PRIVATE_WITH_ADVERTISING = 1;
    case BUSINESS = 2;
    case ADMIN = 3;

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

    public function isAdmin(): bool
    {
        return $this === self::BUSINESS;
    }

    public static function fromString(string $value): self
    {
        return match ($value) {
            'private_without_advertising' => self::PRIVATE_WITHOUT_ADVERTISING,
            'private_with_advertising' => self::PRIVATE_WITH_ADVERTISING,
            'business' => self::BUSINESS,
            'admin' => self::ADMIN,
            default => throw new \InvalidArgumentException("Invalid role: $value"),
        };
    }

    public static function publicRoles(): array
    {
        return [
            self::PRIVATE_WITHOUT_ADVERTISING,
            self::PRIVATE_WITH_ADVERTISING,
            self::BUSINESS,
        ];
    }

    public function getLabel(): string {
        return match ($this) {
            self::PRIVATE_WITHOUT_ADVERTISING => __('advert.bidding'),
            self::PRIVATE_WITH_ADVERTISING => __('advert.auction'),
            self::BUSINESS => __('advert.rental'),
        };
    }

    public function getIcon(): string {
        return match ($this) {
            self::PRIVATE_WITHOUT_ADVERTISING => 'fa-user',
            self::PRIVATE_WITH_ADVERTISING => 'fa-user',
            self::BUSINESS => 'fa-building',
        };
    }
}
