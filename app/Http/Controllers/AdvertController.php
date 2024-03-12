<?php

namespace App\Http\Controllers;

use App\Enum\AdvertType;
use App\Models\Advert;
use App\Models\AdvertImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdvertController extends Controller
{
    const MAX_IMAGES = 5;

    public function createAdvert(): View
    {
        $types = AdvertType::cases();
        $maxImages = self::MAX_IMAGES;
        return view('advert.create', compact('types', 'maxImages'));
    }

    public function storeAdvert(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'type' => 'required',
            'images' => 'required|array|max:' . self::MAX_IMAGES,
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'price' => $request->type === 'Sale' || $request->type === 'Rental' ? 'required' : 'nullable',
            'starting_price' => $request->type === 'Auction' || $request->type === 'Bidding'? 'required' : 'nullable',            'start_date' => $request->type === 'Auction' ? 'required|date' : 'nullable',
            'end_date' => $request->type === 'Auction' ? 'required|date|after:start_date' : 'nullable',
        ]);

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
            foreach ($request->file('images') as $image) {
                $name = time() . '_' . $image->getClientOriginalName();
                $path = $image->move(public_path('storage/images'), $name);
                $advertImage = new AdvertImage();
                $advertImage->advert_id = $advert->id;
                $advertImage->path = $name;
                $advertImage->save();
            }
        }

        return redirect()->route('home');
    }
}
