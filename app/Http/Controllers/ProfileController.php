<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\View\View;
use Psy\Readline\Hoa\Console;

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

        return view('profile', ['user' => $user, 'averageRating' => $averageRating, 'reviewsCount' => $reviewsCount, 'reviews' => $reviews]);
    }
}
