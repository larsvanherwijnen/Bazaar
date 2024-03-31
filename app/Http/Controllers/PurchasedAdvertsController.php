<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PurchasedAdvertsController extends Controller
{

    public function __invoke(): View
    {
        $user = auth()->user();
        $purchasedAdverts = Advert::where('bought_by', $user->id)->get();
        $rentedAdverts = $user->rentals->map(function ($rental) {
            return $rental->advert;
        });

        $purchasedAdverts = $purchasedAdverts->merge($rentedAdverts);
        $purchasedAdverts = $purchasedAdverts->map(function ($advert) use ($user) {
            $advert->rentals = $user->rentals->where('advert_id', $advert->id);
            return $advert;
        });
        return view('purchased_adverts')->with(['purchasedAdverts' => $purchasedAdverts]);
    }
}
