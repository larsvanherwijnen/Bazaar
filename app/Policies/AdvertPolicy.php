<?php

namespace App\Policies;

use App\Enum\AdvertType;
use App\Models\Advert;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdvertPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user): bool
    {

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, AdvertType $advertType, $allowedToCreate): bool
    {
        if (in_array($advertType, [AdvertType::SALE,AdvertType::AUCTION, AdvertType::BIDDING])) {
            return $user->adverts()->where('type', $advertType)->count() < $allowedToCreate;
        } elseif ($advertType == AdvertType::RENTAL) {
            return $user->adverts()->where('type', $advertType)->count() < $allowedToCreate;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Advert $advert): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Advert $advert): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Advert $advert): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Advert $advert): bool
    {
        //
    }
}
