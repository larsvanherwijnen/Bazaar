@extends('layouts.app')
@vite('resources/js/rating.js')
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
                        @if($advert->type == App\Enum\AdvertType::AUCTION || $advert->type == App\Enum\AdvertType::BIDDING)
                            <livewire:bidding :advert="$advert"/>
                        @elseif($advert->type == App\Enum\AdvertType::RENTAL)
                            <livewire:booking :advert="$advert"/>
                            @include('partials.advert_review', ['averageRatingRental' => $averageRatingRental, 'reviewsCountRental' => $reviewsCountRental, 'showReviewCreateButton' => $showReviewCreateButton, 'showReviewButton' => $showReviewButton, ])
                        @elseif($advert->type == App\Enum\AdvertType::SALE)
                            @if(!$advert->bought_by)
                                <form action="{{ route('adverts.sellBuy', ['advert' => $advert->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        {{ __('advert.buy') }}
                                    </button>
                                </form>
                            @else
                                <p class="text-red-500 font-bold">{{__('advert.sold')}}</p>
                            @endif
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