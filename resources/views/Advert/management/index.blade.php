@extends('layouts.app')

@section('content')
    @include('partials.my_account_header')

    @foreach($adverts as $advert)
        @include('partials.advert_card', ['advert' => $advert])
    @endforeach


@endsection