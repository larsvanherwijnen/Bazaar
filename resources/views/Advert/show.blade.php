@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    @include('partials.search')
    <section class="py-12 sm:py-16">
        <div class="w-full md:w-1/2 mx-auto px-4">
            <div class="lg:col-gap-12 xl:col-gap-16 mt-8 grid grid-cols-1 gap-12 lg:mt-12 lg:grid-cols-5 lg:gap-16">
                <div x-data="{ mainImage: '' }"
                     x-init="mainImage = '{{ $advert->advertImages->first() ? Storage::url('images/' . $advert->advertImages->first()->path) : Storage::url('images/img.png') }}'"
                     class="lg:col-span-3 lg:row-end-1">
                    <div class="lg:flex lg:items-start">
                        <div class="lg:order-2 lg:ml-5">
                            <div class="max-w-xl overflow-hidden rounded-lg">
                                <img x-bind:src="mainImage" class="h-full w-full max-w-full object-cover" alt=""/>
                            </div>
                        </div>

                        <div class="mt-2 w-full lg:order-1 lg:w-32 lg:flex-shrink-0">
                            <div class="flex flex-row items-start lg:flex-col">
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
                </div>

                <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
                    <h1 class="sm: text-2xl font-bold text-gray-900 sm:text-3xl">{{ $advert->title }}</h1>
                    <div class="flex flex-col">
                        <a class="mt-5 text-blue-700" href="{{ route('profile', $advert->user->url) }}">{{$advert->user->name}}</a>
                        <div class="mt-2 flex">
                            <div class="flex items-center">
                                <svg class="block h-4 w-4 align-middle text-yellow-500"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                          class=""></path>
                                </svg>
                                <svg class="block h-4 w-4 align-middle text-yellow-500"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                          class=""></path>
                                </svg>
                                <svg class="block h-4 w-4 align-middle text-yellow-500"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                          class=""></path>
                                </svg>
                                <svg class="block h-4 w-4 align-middle text-yellow-500"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                          class=""></path>
                                </svg>
                                <svg class="block h-4 w-4 align-middle text-yellow-500"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                                          class=""></path>
                                </svg>
                            </div>
                            <p class="ml-2 text-sm font-medium text-gray-500">1,209 Reviews</p>
                        </div>
                    </div>
                    <div>
                        <div class="mt-10 flex flex-col items-center justify-between space-y-4 border-t py-4 sm:flex-row sm:space-y-0">
                            @if($advert->type == \App\Enum\AdvertType::SALE)
                                <span class="text-2xl font-bold">€{{$advert->price}}</span>
                            @elseif($advert->type == \App\Enum\AdvertType::AUCTION)
                                @php
                                    $endDate = new DateTime($advert->end_date);
                                    $now = new DateTime();
                                    $interval = $now->diff($endDate);
                                    $daysRemaining = $interval->days;
                                @endphp

                                @if ($daysRemaining > 1)
                                    <span class="text-2xl font-bold">€{{$advert->starting_price}}</span>
                                    <span>Ends in {{$daysRemaining}} days</span>
                                @elseif ($daysRemaining == 1)
                                    <span class="text-2xl font-bold">€{{$advert->starting_price}}</span>
                                    <span>Ends in 1 day</span>
                                @elseif ($now < $endDate)
                                    <span class="text-2xl font-bold">€{{$advert->starting_price}}</span>
                                    <span>Ending soon</span>
                                @else
                                    <span class="text-2xl font-bold">€{{$advert->starting_price}}</span>
                                    <span>Verlopen</span>
                                @endif

                            @endif
                        </div>
                        @if($advert->type == \App\Enum\AdvertType::AUCTION)
                            <div class="flex flex-col" x-data="{amount: ''}">
                                <div class="relative w-full">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-2 text-gray-700">€</span>
                                    <input  x-model="amount" class="pl-8 pr-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-300 w-full" name="amount" autocomplete="off" id="amount" type="text" value=""
                                            @input="amount = amount.replace(/[^0-9,]/g, '').replace(/(,\d{0,2})[^,]*/g, '$1')">
                                </div>
                                <button class="bg-slate-800 p-2 rounded text-white">Place bid</button>
                            </div>
                        @endif
                    </div>

                    <div class="mt-8 space-y-2">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(128)->generate(route('adverts.show', $advert))) !!} ">
                    </div>
                </div>
                <div class="lg:col-span-3">
                    <div class="border-b border-gray-300">
                        <nav class="flex gap-4">
                            <a href="#" title=""
                               class="border-b-2 border-gray-900 py-4 text-sm font-medium text-gray-900 hover:border-gray-400 hover:text-gray-800">
                                {{__('global.related_adverts')}} </a>
                        </nav>
                    </div>

                    <div class="mt-8 flow-root sm:mt-12">
                        <h1 class="text-3xl font-bold">Delivered To Your Door</h1>
                        <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia accusantium
                            nesciunt fuga.</p>
                        <h1 class="mt-8 text-3xl font-bold">From the Fine Farms of Brazil</h1>
                        <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio numquam enim
                            facere.</p>
                        <p class="mt-4">Amet consectetur adipisicing elit. Optio numquam enim facere. Lorem ipsum dolor
                            sit amet consectetur, adipisicing elit. Dolore rerum nostrum eius facere, ad neque.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection