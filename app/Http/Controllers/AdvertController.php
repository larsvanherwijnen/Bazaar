<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\Bid;
use DateTime;
use Illuminate\Http\RedirectResponse;
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
        $user = auth()->user();
        $reviews = $advert->reviews;
        $userReviews = $advert->user->reviews;

        $data = [
            'advert' => $advert,
            'reviewsCount' => $userReviews->count(),
            'averageRating' => $userReviews->avg('rating'),
            'reviewsCountRental' => $reviews->count(),
            'averageRatingRental' => $reviews->avg('rating'),
            'showReviewButton' => $reviews->whereNotNull('comment')->count() > 0,
            'showReviewCreateButton' => $user ? $reviews->where('reviewer_id', $user->id)->isEmpty() : false,        'reviews' => $reviews->whereNotNull('comment'),
        ];

        return view('advert.show')->with($data);
    }

    public function sellBuy(Advert $advert, ?Bid $bid = null): RedirectResponse
    {
        if ($bid) {
            $advert->bought_by = $bid->user_id;
        } else {
            $advert->bought_by = auth()->id();
        }
        $advert->bought_at = now();
        $advert->save();

        return redirect()->back();
    }
}
