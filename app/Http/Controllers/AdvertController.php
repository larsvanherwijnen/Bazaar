<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\View\View;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Advert $advert): View
    {
        $reviewsCount = $advert->user->reviews->count();
        $averageRating = $advert->user->reviews->avg('rating');

        return view('advert.show')->with(['advert' => $advert, 'reviewsCount' => $reviewsCount, 'averageRating' => $averageRating]);
    }
}
