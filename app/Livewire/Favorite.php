<?php

namespace App\Livewire;

use App\Models\Advert;
use Livewire\Component;

class Favorite extends Component
{

    public Advert $advert;

    public function favorite()
    {
        auth()->user()->favorites()->create([
            'advert_id' => $this->advert->id,
        ]);
    }

    public function unfavorite()
    {
        auth()->user()->favorites()->where('advert_id', $this->advert->id)->delete();
    }

    public function render()
    {
        return view('livewire.favorite');
    }
}
