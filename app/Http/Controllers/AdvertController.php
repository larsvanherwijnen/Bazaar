<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\AdvertImage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvertController extends Controller
{
    public function createAdvert(): View
    {
        return view('advert.create');
    }
     public function storeAdvert(Request $request)
     {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'price' => 'required',
                'type' => 'required',
                'images' => 'required',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $advert = new Advert();
            $advert->title = $request->title;
            $advert->description = $request->description;
            $advert->price = $request->price;
            $advert->type = $request->type;
            $advert->save();
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $name);
                    $advertImage = new AdvertImage();
                    $advertImage->name = $name;
                    $advertImage->advert_id = $advert->id;
                    $advertImage->save();
                }
            }
            return redirect()->route('home');
     }


}
