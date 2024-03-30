<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class FavoritesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        return view('favorites')->with('favorites', auth()->user()->favorites()->paginate(10));
    }
}
