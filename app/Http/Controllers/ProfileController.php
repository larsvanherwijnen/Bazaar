<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the profile for the given user.
     */
    public function __invoke(string $url): View
    {
        $user = User::where('url', $url)->first();
        $averageRating = Review::where('user_id', $user->id)->average('rating');
        $reviewsCount = $user->reviews->count();
        $reviews = $user->reviews->whereNotNull('comment');

        $showCreateButton = false;
        if (auth()->check()) {
            $hasReviewed = $user->reviews->contains('reviewer_id', auth()->id());
            $showCreateButton = auth()->id() != $user->id && ! $hasReviewed;
        }

        return view('profile', ['user' => $user, 'averageRating' => $averageRating, 'reviewsCount' => $reviewsCount, 'reviews' => $reviews, 'showCreateButton' => $showCreateButton]);
    }
}
