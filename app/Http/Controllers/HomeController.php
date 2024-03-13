<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $adverts = Advert::with('advertImages')->get();

        return view('home', ['adverts' => $adverts]);
    }

    public function search(Request $request): View
    {
        $min_price = $request->get('min_price');
        $max_price = $request->get('max_price');
        $query = $request->get('query');

        $adverts = Advert::query();

        if ($min_price) {
            $adverts->where('price', '>=', $min_price);
        }

        if ($max_price) {
            $adverts->where('price', '<=', $max_price);
        }

        if ($query) {
            $adverts->where('title', 'like', '%'.$query.'%');
        }

        $adverts = $adverts->get();

        return view('home', ['adverts' => $adverts]);
    }
}
