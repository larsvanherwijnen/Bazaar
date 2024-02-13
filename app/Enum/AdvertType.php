<?php

namespace App\Enum;

enum AdvertType: string
{
    case BIDDING = 'Bidding';
    case AUCTION = 'Auction';
    case RENTAL = 'Rental';
    case SALE = 'Sale';
}
