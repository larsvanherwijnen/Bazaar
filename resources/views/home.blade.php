@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    @include('partials.search')
    <main class="container mx-auto">

        <div class="flex flex-wrap space-x-4 my-10">
            @if ($adverts->isEmpty())
                <div class="w-full text-center py-8">
                    <p class="text-xl">No adverts found.</p>
                </div>
            @else
                @foreach ($adverts as $advert)
                    <a href="{{route('adverts.show', $advert)}}" class="w-1/6 max-w-1/6 bg-white rounded shadow flex flex-col hover:shadow-xl">
                        <img src="{{ $advert->advertImages->first() ? Storage::url('images/' . $advert->advertImages->first()->path) : Storage::url('images/img.png') }}"
                             alt="Advert Image" class="w-full h-48 object-cover rounded-t">
                        <div class="px-4 py-2 space-y-2">
                            <h2 class="text-md font-bold truncate">{{ $advert->title }}</h2>
                            <p class="text-sm font-semibold">€{{ $advert->price }}</p>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </main>
@endsection