<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function index(string $userId) : RedirectResponse
    {
        $user = User::find($userId);
        return redirect()->route('profile', ['slug' => $user->url]);    }

   public function create(User $user) : View
{
    return view('reviews.create', compact('user'));
}


    public function store(ReviewRequest $request) : RedirectResponse
    {
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
    public function destroy(string $id): void
    {
        $review = Review::find($id);
        $review->delete();
    }
}
