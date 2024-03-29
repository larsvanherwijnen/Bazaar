<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $adverts = Advert::with('advertImages')->latest()->limit(10)->get();

        return view('home', ['adverts' => $adverts]);
    }

}
