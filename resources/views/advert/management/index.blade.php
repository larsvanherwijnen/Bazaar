@extends('layouts.app')

@section('content')
    @include('partials.my_account_header')

    @foreach($adverts as $advert)
        <div class="w-1/2 mx-auto my-4">
            @include('partials.advert_card', ['advert' => $advert])
        </div>
    @endforeach

@endsection