<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
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
        /** @var User $reviewedUser */
        $reviewedUser = User::find($request->user_id);
        $existingReview = $reviewedUser->reviews->firstWhere('reviewer_id', $user->id);

        if ($existingReview || $user->id == $reviewedUser->id) {
            return back();
        }

        if ($request->validated()) {
            Review::create($request->validated() + ['reviewer_id' => $user->id]);
        }

        return redirect()->route('profile', ['url' => $reviewedUser->url]);
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
