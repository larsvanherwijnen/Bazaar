@extends('layouts.app')

@section('content')
    @include('partials.user_header', ['user' => $user])
    <div class="container mx-auto pt-8 space-y-4">
        <div class="flex flex-col px-4 bg-gray-300">
            <h2 class="font-bold uppercase text-2xl">{{__('global.featured')}}</h2>
            carousel met de uitgelichte advertenties (max 5 ofz )
        </div>
        <livewire:adverts :user="$user"/>
    </div>
@endsection