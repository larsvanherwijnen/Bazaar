<?php

namespace App\Http\Controllers;

use App\Enum\AdvertType;
use App\Http\Requests\StoreAdvertRequest;
use App\Models\Advert;
use App\Models\AdvertImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertController extends Controller
{
    const MAX_IMAGES = 5;

    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $types = AdvertType::cases();
        $maxImages = self::MAX_IMAGES;

        return view('advert.create', compact('types', 'maxImages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertRequest $request): RedirectResponse
    {
        $advert = new Advert();
        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->type = $request->type;

        if ($request->type === 'Sale' || $request->type === 'Rental') {
            $advert->price = $request->price;
        } else {
            $advert->starting_price = $request->starting_price;
            if ($request->type === 'Auction') {
                if ($advert->price) {
                    // Throw an error or handle this situation as you see fit
                    throw new \Exception('Auction type cannot have a sale price');
                }
                $advert->start_date = $request->start_date;
                $advert->end_date = $request->end_date;
            }
        }

        $advert->save();

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $images = is_array($images) ? $images : [$images];
            foreach ($images as $image) {
                $name = time().'_'.$image->getClientOriginalName();
                $path = $image->move(public_path('storage/images'), $name);
                $advertImage = new AdvertImage();
                $advertImage->advert_id = $advert->id;
                $advertImage->path = $name;
                $advertImage->save();
            }
        }

        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
