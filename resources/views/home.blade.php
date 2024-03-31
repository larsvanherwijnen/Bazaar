@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    @include('partials.search')
    <main class="container mx-auto">
        <h1 class="text-2xl font-bold my-8">Latest Adverts</h1>
        <div class="flex flex-wrap my-10 justify-between">
            @if ($adverts->isEmpty())
                <div class="w-full text-center py-8">
                    <p class="text-xl">No adverts found.</p>
                </div>
            @else
                @foreach ($adverts as $advert)
                    @include('partials.advert_card_small', ['advert' => $advert])
                @endforeach
            @endif
        </div>
    </main>
@endsection
