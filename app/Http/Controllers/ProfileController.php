<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Show the profile for the given user.
     */
    public function __invoke(string $slug): View
    {
        return view('profile', ['user' => User::where('url', $slug)->first()]);
    }
}
