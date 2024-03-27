<?php

namespace App\Enum;

enum AdvertType: string
{
    case SALE = 'Sale';
    case AUCTION = 'Auction';

    case BIDDING = 'Bidding';
    case RENTAL = 'Rental';

    public function getLabel(): string
    {
        return match ($this) {
            self::BIDDING => __('advert.bidding'),
            self::AUCTION => __('advert.auction'),
            self::RENTAL => __('advert.rental'),
            self::SALE => __('advert.sale'),
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::BIDDING => 'fa-building',
            self::AUCTION => 'fa-gavel',
            self::RENTAL => 'fa-home',
            self::SALE => 'fa-tag',
        };
    }
}
