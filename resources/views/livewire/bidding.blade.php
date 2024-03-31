@if($advert->bought_by)
    <div class="flex flex-col bg-white rounded">
        <span class="text-xl font-bold text-gray-900">{{ __('advert.sold') }}</span>
    </div>
@else
<div class="flex flex-col bg-white rounded" x-data="{amount: ''}">
    <form wire:submit="save" class="space-y-4">
        <div class="flex flex-col">
            <span class="text-xl font-bold text-gray-900">{{ __('advert.bidding') }}</span>
            @if($advert->type == \App\Enum\AdvertType::BIDDING)
                <span class="text-sm text-gray-500">{{ __('advert.from', ['start_price' => $advert->starting_price]) }}</span>
            @endif
        </div>
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-gray-700">€</span>
            <input x-model="amount" wire:model="amount"
                   class="pl-8 pr-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 w-full"
                   name="amount" autocomplete="off" id="amount" type="text" value=""
                   @input="amount = amount.replace(/[^0-9,]/g, '').replace(/(,\d{0,2})[^,]*/g, '$1')">
        </div>
        <div>
            @error('amount') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <button type="submit"
                class="border border-blue-700 p-2 rounded text-blue-700 w-full text-md font-semibold"><i
                    class="fa-solid fa-gavel mr-2"></i>{{ __('advert.place_bid') }}</button>
    </form>

    @if($bids->count() > 0)
        <div class="space-y-4 pt-5">
            @foreach($bids as $bid)
                <div class="flex justify-between border-t border-gray-300 py-2">
                    <p>{{ $bid->user->name }}</p>
                    <p>€{{ $bid->amount }}</p>
                    @if(auth()->check() && auth()->user()->id == $advert->user_id)
                        <form action="{{ route('adverts.sell', ['advert' => $advert->id, 'bid' => $bid->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('advert.sellBuy') }}
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <span class="text-sm text-gray-500 text-center p-5">{{ __('advert.no_bids_yet') }}</span>
    @endif
</div>
@endif
