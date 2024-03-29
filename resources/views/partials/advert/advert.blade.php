@php use App\Enum\AdvertType; @endphp
<div class="flex flex-col space-y-5">
    @if(auth()->check() && auth()->user()->id == $advert->user_id)
        <div class="flex space-x-4 justify-end">
            <a href="{{ route('my-account.adverts.edit', $advert) }}" class="bg-yellow-400 rounded p-1 text-sm"><i
                        class="fa-solid fa-pen-to-square mr-2"></i>{{__('global.edit')}}</a>
            <form action="{{route('my-account.adverts.destroy', $advert)}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 rounded p-1 text-sm"><i
                            class="fa-solid fa-trash mr-2"></i>{{__('global.delete')}}</button>
            </form>
        </div>
    @endif
    <div class=" pb-5 flex justify-between">
        <h2 class="text-xl font-bold text-gray-900">{{ $advert->title }}</h2>
        <button class="border border-blue-700 rounded py-2 px-5">
            <i class="fa-regular fa-heart"></i>
            Favoriet
        </button>
    </div>
    <div x-data="{ mainImage: '' }"
         x-init="mainImage = '{{ $advert->advertImages->first() ? Storage::url('images/' . $advert->advertImages->first()->path) : Storage::url('images/img.png') }}'"
         class="flex space-x-5">
        <div class="flex flex-col-reverse">
            <div class="order-2">
                <div class="max-w-96 overflow-hidden rounded-lg">
                    <img x-bind:src="mainImage" class="h-full w-full max-w-full object-cover" alt=""/>
                </div>
            </div>
            <div class="w-full">
                <div class="flex flex-row items-start">
                    @foreach($advert->advertImages as $image)
                        <button type="button"
                                @click="mainImage = '{{ Storage::url('images/' . $image->path) }}'"
                                class="flex-0 aspect-square mb-3 h-20 overflow-hidden rounded-lg border-2 border-transparent text-center">
                            <img class="h-full w-full object-cover"
                                 src="{{ Storage::url('images/' . $image->path) }}" alt=""/>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
        @if($advert->type == AdvertType::BIDDING && $advert->price != null)
            <span class="text-xl font-bold text-gray-900">€{{ $advert->price }}</span>
        @elseif($advert->type == AdvertType::BIDDING)
            <span class="text-xl font-bold text-gray-900">{{ __('advert.bidding') }}</span>
        @elseif($advert->type == AdvertType::AUCTION)
            <span class="text-xl font-bold text-gray-900">{{ __('advert.auction') }}</span>
        @elseif($advert->type == AdvertType::RENTAL)
            <div class="flex flex-col">
                <span class="text-xl font-bold text-gray-900">{{ __('advert.rental') }}</span>
                <span class="text-sm text-gray-500">€{{ $advert->price }}/{{ __('advert.per_day') }}</span>
            </div>
        @else
            <span class="text-xl font-bold text-gray-900">€{{ $advert->price }}</span>
        @endif

    </div>
    <div class="flex flex-col">
        <small class="font-bold text-gray-900 text-xl">{{__('global.description')}}</small>
        {{ $advert->description}}
    </div>
    <div class="mt-8 space-y-2">
        {{--            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(64)->generate(route('adverts.show', $advert))) !!} ">--}}
    </div>
</div>
