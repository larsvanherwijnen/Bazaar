<div>
    @if(auth()->check() && auth()->user()->favorites->where('advert_id', $advert->id)->first())
        <button dusk='unfavorite' type="button" wire:click="unfavorite" class="border border-red-700 rounded py-2 px-5">
            <i class="fa-regular fa-heart"></i>
            {{__('advert.remove_favorite')}}
        </button>
    @elseif(auth()->check())
        <button dusk='favorite' type="button" wire:click="favorite" class="border border-blue-700 rounded py-2 px-5">
            <i class="fa-regular fa-heart"></i>
            {{__('advert.favorite')}}

        </button>
    @endif
</div>
