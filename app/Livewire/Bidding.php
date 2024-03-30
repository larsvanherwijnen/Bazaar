<?php

namespace App\Livewire;

use App\Models\Advert;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Bidding extends Component
{
    public Advert $advert;

    #[Validate('required|min:0.01|max:999999.99')]
    public float $amount;

    public function save(): void
    {
        $this->validate();

        $this->advert->bids()->create([
            'user_id' => auth()->id(),
            'amount' => $this->amount,
        ]);

    }

    public function render(): View
    {
        $bids = $this->advert->bids->collect()->sortByDesc('created_at');

        return view('livewire.bidding')->with('bids', $bids);
    }
}
