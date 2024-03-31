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
        $reviewedUser = null;
        $reviewedAdvert = null;
        if ($request->has('user_id')) {
            /** @var User $reviewedUser */
            $reviewedUser = User::find($request->user_id);
            $existingReview = $reviewedUser->reviews->firstWhere('reviewer_id', $user->id);

            if ($existingReview || $user->id == $reviewedUser->id) {
                return back();
            }
        } elseif ($request->has('advert_id')) {
            /** @var Advert $reviewedAdvert */
            $reviewedAdvert = Advert::find($request->advert_id);
            $existingReview = $reviewedAdvert->reviews->firstWhere('reviewer_id', $user->id);

            if ($existingReview) {
                return back();
            }
        }

        if ($request->validated()) {
            $reviewData = $request->validated() + ['reviewer_id' => $user->id];

            if ($reviewedUser) {
                $reviewData['user_id'] = $reviewedUser->id;
            } elseif ($reviewedAdvert) {
                $reviewData['advert_id'] = $reviewedAdvert->id;
            }
            Review::create($reviewData);
        }

        if ($reviewedUser) {
            return redirect()->route('profile', ['url' => $reviewedUser->url]);
        } elseif ($reviewedAdvert) {
            return redirect()->route('adverts.show', ['advert' => $reviewedAdvert->id]);
        }
        return redirect()->back();
    }

    public function destroy(string $id): RedirectResponse
    {
        $review = Review::find($id);
        if (auth()->id() != $review->reviewer_id) {
            return redirect()->back();
        }
        $review->delete();
        $reviewsLeft = Review::where('user_id', $review->user_id)->count();
        // If there are no reviews left, redirect to profile view
        if ($reviewsLeft == 0) {
            return redirect()->route('profile', ['url' => $review->user->url]);
        }

        return redirect()->back();
    }
}
