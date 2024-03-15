<?php

namespace App\Http\Controllers;

use App\Enum\AdvertType;
use App\Http\Requests\StoreAdvertRequest;
use App\Models\Advert;
use App\Models\AdvertImage;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertController extends Controller
{
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
        $maxImages = 5;

        return view('advert.create', compact('types', 'maxImages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvertRequest $request): RedirectResponse
    {
        $advert = new Advert();
        $this->setAdvertProperties($advert, $request);
        $advert->save();
        $this->handleImageUpload($request, $advert);
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
    public function edit(string $id): View
    {
        $advert = Advert::find($id);
        $types = AdvertType::cases();
        $maxImages = 5;

        return view('advert.edit', compact('advert', 'types', 'maxImages'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id): RedirectResponse
{
    $advert = Advert::findOrFail($id);
    $this->setAdvertProperties($advert, $request);
    $advert->save();
    $this->handleImageUpload($request, $advert);
    return redirect()->route('home');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $advert = Advert::findOrFail($id);
        $advert->delete();

        return redirect()->route('home');
    }


    private function setAdvertProperties(Advert $advert, Request $request): void
    {
        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->type = $request->type;

        if ($request->type === 'Sale' || $request->type === 'Rental') {
            $advert->price = $request->price;
        } else {
            $advert->starting_price = $request->starting_price;
            if ($request->type === 'Auction') {
                $advert->start_date = $request->start_date;
                $advert->end_date = $request->end_date;
            }
        }
    }
    private function handleImageUpload(Request $request, Advert $advert): void
    {
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
    }
}
