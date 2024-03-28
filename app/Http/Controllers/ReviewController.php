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
    public function index(string $userId) : RedirectResponse
    {
        $user = User::find($userId);
        return redirect()->route('profile', ['url' => $user->url]);    }

   public function create(User $user) : View
{
    return view('reviews.create', compact('user'));
}


    public function store(ReviewRequest $request) : RedirectResponse
    {
        $user = Auth::user();
        /** @var User $reviewedUser */
        $reviewedUser = User::find($request->user_id);
        $existingReview = $reviewedUser->reviews->firstWhere('reviewer_id', $user->id);

        if ($existingReview || $user->id == $reviewedUser->id) {
            return back();
        }

        if ($request->validated()) {
            $review = new Review();
            $review->fill($request->validated());
            $review->save();
            return redirect()->route('reviews.index', $review->user_id);
        } else {
            return redirect()->route('reviews.index', $request->user_id);
        }
    }

    public function show(string $userId) : View
    {
        $user = User::find($userId);
        $averageRating = Review::where('user_id', $userId)->average('rating');
        return view('users.show', compact('user', 'averageRating'));
    }

    public function edit(string $id) : View
    {
        $review = Review::find($id);
        return view('reviews.edit', compact('review'));
    }

    public function update(ReviewRequest $request, string $id) : RedirectResponse
    {
        $review = Review::find($id);
        if ($request->validated()) {
            $review->update($request->validated());
            return redirect()->route('reviews.index', $review->user_id);
        }
        return redirect()->route('reviews.index', $review->user_id);
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
