@extends('layouts.app')

@section('content')
    @include('partials.user_header', ['user' => $user])
    <div class="container mx-auto pt-8 space-y-4">
        <div class="flex flex-row flex-wrap justify-center bg-gray-300">
            <h2 class="font-bold uppercase text-2xl w-full mb-4 text-center">{{__('global.featured')}}</h2>
            <div class="flex flex-row flex-wrap justify-center">
                @foreach($adverts as $advert)
                        @include('partials.advert_card_small', ['advert' => $advert])
                @endforeach
            </div>
        </div>
        <livewire:adverts :user="$user"/>
    </div>
@endsection