@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="flex justify-center space-x-4 mt-8">
        <form method="GET" action="{{ route('search') }}"
              class="flex items-center border border-gray-300 rounded px-4 py-2 shadow-lg">
            <div class="flex space-x-2 mr-4">
                <label>
                    <input type="number" name="min_price" placeholder="Min Price"
                           class="w-full outline-none focus:outline-none border border-gray-300 rounded px-2 py-1">
                </label>
                <label>
                    <input type="number" name="max_price" placeholder="Max Price"
                           class="w-full outline-none focus:outline-none border border-gray-300 rounded px-2 py-1">
                </label>
            </div>
            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">
                Filter
            </button>
        </form>
    </div>
    <main class="flex flex-wrap">
    @if ($adverts->isEmpty())
        <div class="w-full text-center py-8">
            <p class="text-xl">No adverts found.</p>
        </div>
    @else
        @foreach ($adverts as $advert)
            <div class="w-1/5 p-4">
                <div class="bg-white rounded shadow p-4 flex flex-col">
                    <div class="mb-2 overflow-hidden overflow-ellipsis">
                        <h2 class="text-xl font-bold whitespace-nowrap">{{ Str::limit($advert->title, 50) }}</h2>
                    </div>
                    <img src="{{ $advert->advertImages->first() ? asset($advert->advertImages->first()->path) : asset('images/img.png') }}" alt="Advert Image" class="w-full h-64 object-cover mb-4">
                    <p class="text-lg font-semibold">€{{ $advert->price }}</p>
                </div>
            </div>
        @endforeach
    @endif
</main>
@endsection