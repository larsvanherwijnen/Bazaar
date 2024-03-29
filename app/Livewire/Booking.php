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
        $existingRental = Rental::where('advert_id', $this->advert->id)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->start, $this->end])
                    ->orWhereBetween('end_date', [$this->start, $this->end]);
            })
            ->first();
        if ($existingRental) {
            session()->flash('message', trans('validation.advert_already_booked'));
            return;
        }
        Rental::create([
            'advert_id' => $this->advert->id,
            'user_id' => auth()->id(),
            'start_date' => $this->start,
            'end_date' => $this->end,
            'price' => $this->advert->price,
        ]);
        session()->flash('message', trans('validation.booking_successful'));
    }


    public function render(): View
    {
        return view('livewire.booking');
    }
}
