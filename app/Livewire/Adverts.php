<?php

namespace App\Livewire;

use App\Models\Advert;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Adverts extends Component
{
    use WithPagination;

    public ?User $user = null;

    #[Url]
    public ?string $search = '';

    public ?string $advertType = null;

    public ?float $minPrice = null;

    public ?float $maxPrice = null;

    public function render(): View
    {
        $adverts = Advert::query()
            ->when($this->user, fn ($query, $user) => $query->where('user_id', $user->id))
            ->when($this->advertType, fn ($query, $type) => $query->where('type', $type))
            ->when($this->minPrice, fn ($query, $minPrice) => $query->where('price', '>=', $minPrice))
            ->when($this->maxPrice, fn ($query, $maxPrice) => $query->where('price', '<=', $maxPrice))
            ->when($this->search, fn ($query, $search) => $query->where('title', 'like', "%$search%"))
            ->paginate(10);

        return view('livewire.adverts')->with(['adverts' => $adverts]);
    }
}
