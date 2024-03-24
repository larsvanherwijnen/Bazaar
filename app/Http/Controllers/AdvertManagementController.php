<?php

namespace App\Http\Controllers;

use App\Enum\AdvertType;
use App\Http\Requests\StoreAdvertRequest;
use App\Models\Advert;
use App\Models\AdvertImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('advert.management.index')->with('adverts', auth()->user()->adverts);
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
        $validated = $request->validated();
        if ($validated['type'] === AdvertType::BIDDING) {
            $validated = $request->safe()->except('price', 'start_date', 'end_date');
        }

        if ($validated['type'] === AdvertType::AUCTION) {
            $validated = $request->safe()->except('price');
        }

        if ($validated['type'] === AdvertType::SALE || $validated['type'] === AdvertType::RENTAL) {
            $validated = $request->safe()->except('starting_price', 'start_date', 'end_date');
        }
        $advert = new Advert();
        $advert->fill($validated);
        $advert->save();
        $this->handleImageUpload($request, $advert);

        auth()->user()->adverts()->save($advert);


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
    public function edit(Advert $advert): View
    {
        $types = AdvertType::cases();
        $maxImages = 5;

        return view('advert.edit', compact('advert', 'types', 'maxImages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAdvertRequest $request, Advert $advert): RedirectResponse
    {
        $validated = $request->validated();

        if ($validated['type'] === AdvertType::BIDDING) {
            $validated = $request->safe()->except('price', 'start_date', 'end_date');
        }

        if ($validated['type'] === AdvertType::AUCTION) {
            $validated = $request->safe()->except('price');
        }

        if ($validated['type'] === AdvertType::SALE || $validated['type'] === AdvertType::RENTAL) {
            $validated = $request->safe()->except('starting_price', 'start_date', 'end_date');
        }
        $advert->update($validated);
        $advert->save();

        $this->handleImageUpload($request, $advert);

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advert $advert): RedirectResponse
    {
        $advert->delete();

        return redirect()->route('home');
    }

    private function handleImageUpload(Request $request, Advert $advert): void
    {
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $images = is_array($images) ? $images : [$images];
            foreach ($images as $image) {
                $name = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('storage/images'), $name);
                $advertImage = new AdvertImage();
                $advertImage->advert_id = $advert->id;
                $advertImage->path = $name;
                $advertImage->save();
            }
        }
    }
}
