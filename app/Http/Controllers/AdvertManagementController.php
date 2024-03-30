<?php

namespace App\Http\Controllers;

use App\Enum\AdvertType;
use App\Http\Requests\StoreUpdateAdvertRequest;
use App\Models\Advert;
use App\Models\AdvertImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Nette\Utils\Paginator;

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

        return view('advert.management.create')->with(['types' => $types, 'maxImages' => $maxImages, 'adverts' => auth()->user()->adverts]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateAdvertRequest $request): RedirectResponse
    {
        if ($request->user()->can('create', [Advert::class, AdvertType::from($request->type), 4])) {

            $validated = $request->validated();
            if ($validated['type'] === AdvertType::BIDDING) {
                $validated = $request->safe()->except('start_date', 'end_date');
            }

            if ($validated['type'] === AdvertType::AUCTION) {
                $validated = $request->safe()->except('price');
            }

            if ($validated['type'] === AdvertType::SALE || $validated['type'] === AdvertType::RENTAL) {
                $validated = $request->safe()->except('starting_price', 'start_date', 'end_date');
            }
            $advert = new Advert();
            $advert->fill($validated);
            auth()->user()->adverts()->save($advert);
            $advert->relatedAdverts()->sync($validated['relatedAdverts']);

            $this->handleImageUpload($request, $advert);

            return redirect()->route('home');
        } else {
            return redirect()->route('home')->with('error', 'You have reached the maximum number of adverts allowed.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advert $advert): View
    {
        $types = AdvertType::cases();
        $maxImages = 5;
        $advert->load(['advertImages', 'relatedAdverts']);
        $relatedAdvertsIds = $advert->relatedAdverts()->pluck('related_advert_id')->toArray();

        return view('advert.management.edit')->with(['advert' => $advert, 'types' => $types, 'maxImages' => $maxImages, 'adverts' => auth()->user()->adverts, 'relatedAdvertsIds' => $relatedAdvertsIds]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateAdvertRequest $request, Advert $advert): RedirectResponse
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
        $advert->relatedAdverts()->sync($validated['relatedAdverts'] ?? []);
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
                $name = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage/images'), $name);
                $advertImage = new AdvertImage();
                $advertImage->advert_id = $advert->id;
                $advertImage->path = $name;
                $advertImage->save();
            }
        }
    }
}
