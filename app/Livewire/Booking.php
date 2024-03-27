<?php

namespace App\Livewire;

use App\Models\Advert;
use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Booking extends Component
{
    public Advert $advert;

    #[Validate('required|date|after_or_equal:today|before_or_equal:end_date')]
    public string $start;
    #[Validate('required|date|after_or_equal:start')]
    public string $end;

    public function mount() : void
    {
        $this->start = Carbon::today()->toDateString();
        $this->end = Carbon::today()->addDay()->toDateString();
    }

    public function save() : void
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.booking');
    }
}
