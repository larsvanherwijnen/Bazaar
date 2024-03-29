<?php

namespace App\Livewire;

use App\Models\Advert;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Booking extends Component
{
    public Advert $advert;

    #[Validate('required|date|after_or_equal:today')]
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
    }

    public function render(): View
    {
        return view('livewire.booking');
    }
}
