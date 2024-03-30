<?php

namespace App\Policies;

use App\Enum\AdvertType;
use App\Models\Advert;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdvertPolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, AdvertType $advertType, int $allowedToCreate): bool
    {
        if (in_array($advertType, [AdvertType::SALE,AdvertType::AUCTION, AdvertType::BIDDING])) {
            return $user->adverts()->where('type', $advertType)->count() < $allowedToCreate;
        } elseif ($advertType == AdvertType::RENTAL) {
            return $user->adverts()->where('type', $advertType)->count() < $allowedToCreate;
        }
    }
}
