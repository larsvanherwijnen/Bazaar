<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        return view('advert.index')->with(['search' => $request->get('search')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Advert $advert): View
    {
        $reviewsCount = $advert->user->reviews->count();
        $averageRating = $advert->user->reviews->avg('rating');
        $reviewsCountRental = $advert->reviews->count();
        $averageRatingRental = $advert->reviews->avg('rating');
        $user = auth()->user();
        $showReviewCreateButton = $advert->reviews->where('reviewer_id', $user->id)->isEmpty();
        $reviews = $advert->reviews()->whereNotNull('comment');
        $showReviewButton = $reviews->count() > 0;

        return view('advert.show')->with(['advert' => $advert, 'reviewsCount' => $reviewsCount, 'averageRating' => $averageRating, 'reviewsCountRental' => $reviewsCountRental, 'averageRatingRental' => $averageRatingRental, 'showReviewButton' => $showReviewButton, 'reviews' => $reviews, 'showReviewCreateButton' => $showReviewCreateButton]);
    }
}
