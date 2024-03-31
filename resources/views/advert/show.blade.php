@extends('layouts.app')
@php use App\Enum\AdvertType; @endphp

@section('content')
    @include('partials.search')
    <section class="py-12 sm:py-16">
        <div class="w-full max-w-screen-lg mx-auto px-4 flex flex-col space-y-4">
            <div class="flex space-x-4">
                <div class="bg-white p-5 rounded w-2/3">
                    @include('partials.advert.advert', $advert)
                </div>
                <div class="flex flex-col space-y-5 w-1/3">
                    <div class="bg-white p-5 rounded flex-col">
                        @include('partials.advert.seller', $advert)
                    </div>
                    <div class="bg-white p-5 rounded flex-col">
                        @if($advert->type == AdvertType::AUCTION || $advert->type == AdvertType::BIDDING)
                            <livewire:bidding :advert="$advert"/>
                        @elseif($advert->type == AdvertType::RENTAL)
                            <livewire:booking :advert="$advert"/>
                        @endif
                    </div>
                </div>
            </div>
            @if(count($advert->relatedAdverts) != 0)
                <div class="bg-white p-5 rounded flex-col">
                    @include('partials.advert.info', $advert)
                </div>
            @endif

        </div>
    </section>

@endsection