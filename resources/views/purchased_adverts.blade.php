@extends('layouts.app')

@section('content')
    @include('partials.my_account_header')

    @foreach($purchasedAdverts as $purchasedAdvert)
        <div class="grid grid-cols-3 gap-4 my-4">
            <div class="col-span-2">
                @include('partials.advert_card', ['advert' => $purchasedAdvert])
            </div>
            <div class="col-span-1 bg-gray-100 p-4 rounded">
                <p class="text-gray-600 font-semibold">{{ __('advert.' . strtolower($purchasedAdvert->type->value)) }}</p>
                @if($purchasedAdvert->type == \App\Enum\AdvertType::RENTAL)
                    <p class="text-gray-600 font-semibold mt-2">{{__('global.rent_dates')}}:</p>
                    @foreach($purchasedAdvert->rentals as $rental)
                        <p>{{ __('global.from') }}: {{ \Carbon\Carbon::parse($rental->start_date)->format(__('global.date_format')) }} {{ __('global.to') }}: {{ \Carbon\Carbon::parse($rental->end_date)->format(__('global.date_format')) }}</p>
                    @endforeach
                @else
                    <p class="text-gray-600 font-semibold mt-2">{{__('advert.date_bought')}}:</p>
                    <p>{{ \Carbon\Carbon::parse($purchasedAdvert->bought_at)->format(__('global.date_format')) }}</p>
                @endif
            </div>
        </div>
    @endforeach

@endsection