@extends('layouts.app')
@section('content')
    @vite('resources/js/advert.js')
    <div class="flex justify-center mt-20">
        <div class="bg-white p-10 rounded shadow-md w-1/3">
            <h1 class="text-2xl mb-6 text-center">{{ __('advert.create_advert') }}</h1>
            <form method="post" action="{{ route('advert.store') }}" enctype="multipart/form-data" class="space-y-4" x-data="{ advertType: '{{ old('type', 'Sale') }}' }">                @csrf
                <input type="hidden" id="type" name="type" x-model="advertType">

                <div class="flex items-center space-x-4">
                    <div class="w-1/3 bg-gray-200 rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': advertType === 'Sale'}"
                         @click="advertType = 'Sale'">
                        <i class="fa-solid fa-tag text-2xl"></i>
                        <div class="flex flex-col text-center">
                            <span>{{ __('advert.sale') }}</span>
                        </div>
                    </div>
                    <div class="w-1/3 bg-gray-200  rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': advertType === 'Auction'}"
                         @click="advertType = 'Auction'">
                        <i class="fa-solid fa-gavel text-2xl"></i>
                        <div class="flex flex-col text-center">
                            <span>{{ __('advert.auction') }}</span>
                        </div>
                    </div>
                    <div class="w-1/3 bg-gray-200 rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': advertType === 'Bidding'}"
                         @click="advertType = 'Bidding'">
                        <i class="fa-solid fa-building text-2xl"></i>
                        <div class="flex flex-col text-center">
                            <span>{{ __('advert.bidding') }}</span>
                        </div>
                    </div>
                    <div class="w-1/3 bg-gray-200 rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': advertType === 'Rental'}"
                         @click="advertType = 'Rental'">
                        <i class="fa-solid fa-home text-2xl"></i>
                        <div class="flex flex-col text-center">
                            <span>{{ __('advert.rental') }}</span>
                        </div>
                    </div>
                </div>
                <div class="border-b-2 border-gray-500"></div>
                <div>
                    @error('title')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                    <label for="title" class="block text-sm font-medium text-gray-700">{{ __('advert.attributes.title') }}:</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    @error('description')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                    <label for="description" class="block text-sm font-medium text-gray-700">{{ __('global.description') }}:</label>
                    <textarea id="description" name="description" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                </div>
                <div>
                    @if($errors->has('images'))
                        <div class="text-red-500 mt-2 text-sm">The images field is required.</div>
                    @endif
                    <p class="text-green-600 font-semibold mb-4">
                        0 {{ __('global.of') }} {{ $maxImages }} {{ __('advert.photos') }} {{ __('advert.used') }}!
                    </p>
                    <div class="border-2 border-dashed border-gray-300 p-4 mb-4 text-center cursor-pointer hover:bg-gray-100">
                        <input type="file" id="images" name="images[]" accept="image/*" class="hidden" multiple data-max-images="{{ $maxImages }}">
                        <label for="images" class="text-gray-500">
                            {{__('advert.Click_or_drag_to_upload_a_photo')}}
                        </label>
                    </div>
                </div>
                <div id="image-preview" class="grid grid-cols-4 grid-rows-2 gap-2">
                    <div class="image-placeholder col-span-2 row-span-2 border border-gray-300 rounded overflow-hidden h-full">
                        <img src="https://placehold.co/600x400?text=Your+image+goes+here" class="w-full h-full object-cover" alt="">
                    </div>
                    @for ($i = 1; $i < 5; $i++)
                        <div class="image-placeholder col-span-1 row-span-1 border border-gray-300 rounded overflow-hidden h-full">
                            <img src="https://placehold.co/600x400?text=Your+image+goes+here" class="w-full h-full object-cover" alt="">                        </div>
                    @endfor
                    <input type="hidden" id="totalImages" name="totalImages" value="0">
                </div>

                <div class="border-b-2 border-gray-500"> </div>

                <div x-show="advertType === 'Sale' || advertType === 'Rental'">
                    <div>
                        @error('price')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <label for="price" class="block text-sm font-medium text-gray-700">{{__('advert.price')}}:</label>
                        <input type="number" id="price" name="price" value="{{ old('price') }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div x-show="advertType === 'Auction' || advertType === 'Bidding'">
                    @error('starting_price')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                    <label for="starting_price" class="block text-sm font-medium text-gray-700">{{__('advert.attributes.starting_price')}}:</label>
                    <input type="number" id="starting_price" name="starting_price" value="{{ old('starting_price') }}" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div x-show="advertType === 'Auction'">
                    <div>
                        @error('start_date')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <label for="start_date" class="block text-sm font-medium text-gray-700">{{__('advert.attributes.start_date')}}:</label>
                        <input type="datetime-local" id="start_date" name="start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        @error('end_date')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <label for="end_date" class="block text-sm font-medium text-gray-700">{{__('advert.attributes.end_date')}}:</label>
                        <input type="datetime-local" id="end_date" name="end_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div x-show="advertType === 'Bidding'">

                </div>
                <div>
                    <input type="submit" value="{{__('global.submit')}}" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                </div>
            </form>
        </div>
    </div>
@endsection

