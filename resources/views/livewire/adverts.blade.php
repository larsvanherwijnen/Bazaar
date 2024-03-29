<div class="flex space-x-4">
    <div class="w-2/7 rounded bg-white flex h-fit p-4 flex-col space-y-4">
        <h2 class="font-bold text-gray-900 text-2xl">{{__('global.filter')}}</h2>

        <select wire:model.live="advertType" class="w-full p-2 border border-gray-300 rounded">
            <option value="">{{__('advert.all_advert_types')}}</option>
            @foreach(\App\Enum\AdvertType::cases() as $advertType)
                <option value="{{$advertType->value}}">{{$advertType->getLabel()}}</option>
            @endforeach
        </select>
        <div class="flex space-x-4">
            <div x-data="{min: ''}">
                <label for="minPrice" class="block text-sm font-medium text-gray-700">{{__('global.min_price')}}</label>
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-gray-700">€</span>
                    <input x-model="min" wire:model.live="minPrice"
                           class="pl-8 pr-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 w-full"
                           autocomplete="off" id="minPrice" type="text" value=""
                           @input="min = min.replace(/[^0-9,]/g, '').replace(/(,\d{0,2})[^,]*/g, '$1')">
                </div>
            </div>

            <div x-data="{max: ''}">
                <label for="maxPrice" class="block text-sm font-medium text-gray-700">{{__('global.max_price')}}</label>
                <div class="relative w-full">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-gray-700">€</span>
                    <input x-model="max" wire:model.live="maxPrice"
                           class="pl-8 pr-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 w-full"
                           autocomplete="off" id="maxPrice" type="text" value=""
                           @input="max = max.replace(/[^0-9,]/g, '').replace(/(,\d{0,2})[^,]*/g, '$1')">
                </div>
            </div>
        </div>
    </div>
    <div class="flex-1 space-y-4">
        @foreach($adverts as $advert)
            @include('partials.advert_card', $advert)
        @endforeach
        {{ $adverts->links()}}
    </div>
</div>