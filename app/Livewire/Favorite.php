<?php

namespace App\Livewire;

use App\Models\Advert;
use Illuminate\View\View;
use Livewire\Component;

class Favorite extends Component
{

    public Advert $advert;

    public function favorite(): void
    {
        auth()->user()->favorites()->create([
            'advert_id' => $this->advert->id,
        ]);
    }

    public function unfavorite(): void
    {
        auth()->user()->favorites()->where('advert_id', $this->advert->id)->delete();
    }

    public function render(): View
    {
        return view('livewire.favorite');
    }
}
