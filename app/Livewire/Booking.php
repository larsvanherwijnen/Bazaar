<?php

namespace App\Livewire;

use App\Models\Advert;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Booking extends Component
{
    public Advert $advert;

    #[Validate('required|date|after_or_equal:today|before_or_equal:end_date')]
    public string $start;

    #[Validate('required|date|after_or_equal:start')]
    public string $end;

    public function mount(): void
    {
        $this->start = Carbon::today()->toDateString();
        $this->end = Carbon::today()->addDay()->toDateString();
    }

    public function save(): void
    {
        $this->validate();
        Rental::create([
            'advert_id' => $this->advert->id,
            'user_id' => auth()->id(),
            'start_date' => $this->start,
            'end_date' => $this->end,
            'price' => $this->advert->price,
        ]);
    }


    public function render(): View
    {
        return view('livewire.booking');
    }
}
