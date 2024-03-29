@extends('layouts.app')

@section('content')
    @include('partials.my_account_header')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">{{__('global.agenda')}}</h1>

        @if (count($rentals) > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-6">
                @foreach ($rentalsByDate as $date => $dailyRentals)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h2 class="text-xl font-bold mb-2">{{ \Carbon\Carbon::parse($date)->format('F d, Y') }}</h2>
                        @foreach ($dailyRentals as $rental)
                            <div class="bg-gray-100 rounded-lg p-4 mb-4">
                                <h3 class="text-lg font-semibold">{{ $rental->advert->title }}</h3>
                                <p class="text-gray-600">{{ __('global.rented_by')}} {{ $rental->user->name }}</p>
                                <div class="mt-2">
                                    @if ($date === \Carbon\Carbon::parse($rental->start_date)->format('Y-m-d'))
                                        <p class="text-green-600 font-bold">{{ __('global.pickup') }}: {{ \Carbon\Carbon::parse($rental->start_date)->format('M d, Y') }}</p>
                                    @endif
                                    @if ($date === \Carbon\Carbon::parse($rental->end_date)->format('Y-m-d'))
                                        <p class="text-red-600 font-bold">{{ __('global.return')}}: {{ \Carbon\Carbon::parse($rental->end_date)->format('M d, Y') }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            {{ $rentals->links() }}
        @else
            <p class="text-gray-600">{{ __('global.no_rentals_found') }}</p>
        @endif
    </div>
@endsection