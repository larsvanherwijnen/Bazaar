<?php

namespace App\Livewire;

use App\Models\Advert;
use DateTime;
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
        $advert = $this->advert;
        $bids = $advert->bids->collect()->sortByDesc('created_at');
        $endDate = new DateTime($advert->end_date);
        $now = new DateTime();
        $interval = $now->diff($endDate);
        $daysRemaining = $interval->days;
        if ($endDate < $now) {
            $daysRemaining = -1;
        }
        return view('livewire.bidding')->with(['bids' => $bids, 'daysRemaining' => $daysRemaining, 'now' => $now, 'endDate' => $endDate]);
    }
}
