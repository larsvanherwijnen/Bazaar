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

        <form method="GET" action="{{ route('search') }}"
              class="flex items-center border border-gray-300 rounded-full px-4 py-2 shadow-lg w-96">
            <label>
                <input type="text" name="query" placeholder="Search..." class="w-full outline-none focus:outline-none">
            </label>
            <button type="submit" class="bg-blue-500 text-white rounded-full px-4 py-2 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M8.5 16a7.5 7.5 0 100-15 7.5 7.5 0 000 15zm6.854-2.146l4.647 4.646-1.708 1.708-4.646-4.647a6.5 6.5 0 111.707-1.707zM15 9a6 6 0 11-12 0 6 6 0 0112 0z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
        </form>
    </div>
    <main class="flex flex-wrap">
        @foreach ($adverts as $advert)
            <div class="w-1/5 p-4">
                <div class="bg-white rounded shadow p-4 flex flex-col">
                    <div class="mb-2 overflow-hidden overflow-ellipsis">
                        <h2 class="text-xl font-bold whitespace-nowrap">{{ Str::limit($advert->title, 50) }}</h2>
                    </div>
                    <img src="{{ asset('images/img.png') }}" alt="Example Image" class="w-full h-64 object-cover mb-4">
                    <p class="text-lg font-semibold">€{{ $advert->price }}</p>
                </div>
            </div>
        @endforeach
    </main>
@endsection