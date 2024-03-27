<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\View\View;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Advert $advert): View
    {
        return view('advert.show', compact('advert'));
    }
}
