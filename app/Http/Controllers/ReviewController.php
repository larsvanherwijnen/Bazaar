<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Advert;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request): RedirectResponse
{
    $user = Auth::user();
    /** @var User|null $reviewedUser */
    $reviewedUser = $request->has('user_id') ? User::find($request->user_id) : null;
    /** @var Advert|null $reviewedAdvert */
    $reviewedAdvert = $request->has('advert_id') ? Advert::find($request->advert_id) : null;

    $existingReview = $reviewedUser ?
        $reviewedUser->reviews->firstWhere('reviewer_id', $user->id) :
        $reviewedAdvert->reviews->firstWhere('reviewer_id', $user->id);
    if ($existingReview || ($reviewedUser && $user->id == $reviewedUser->id)) {
        return back();
    }

    if ($request->validated()) {
        $reviewData = $request->validated() + ['reviewer_id' => $user->id];
        Review::create($reviewData);
    }

    return $reviewedUser ?
        redirect()->route('profile', ['url' => $reviewedUser->url]) :
        redirect()->route('adverts.show', ['advert' => $reviewedAdvert->id]);
}

    public function destroy(string $id): RedirectResponse
    {
        $review = Review::find($id);
        if (auth()->id() != $review->reviewer_id) {
            return redirect()->back();
        }
        $review->delete();

        $redirectRoute = $review->user_id ? 'profile' : 'adverts.show';
        $redirectParam = $review->user_id ? ['url' => $review->user->url] : ['advert' => $review->advert_id];
        $reviewsLeft = Review::where($review->user_id ? 'user_id' : 'advert_id', $review->user_id ?: $review->advert_id)->count();

        if ($reviewsLeft == 0) {
            return redirect()->route($redirectRoute, $redirectParam);
        }

        return redirect()->back();
    }
}
