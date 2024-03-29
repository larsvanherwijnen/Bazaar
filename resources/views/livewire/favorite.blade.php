<div>
    @if(auth()->check() && auth()->user()->favorites->where('advert_id', $advert->id)->first())
        <button type="button" wire:click="unfavorite" class="border border-red-700 rounded py-2 px-5">
            <i class="fa-regular fa-heart"></i>
            Favoriet
        </button>
    @elseif(auth()->check())
        <button type="button" wire:click="favorite" class="border border-blue-700 rounded py-2 px-5">
            <i class="fa-regular fa-heart"></i>
            Favoriet
        </button>
    @endif
</div>
