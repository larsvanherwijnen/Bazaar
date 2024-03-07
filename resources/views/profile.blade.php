@extends('layouts.app')

@section('content')
    @include('partials.user_header', ['user' => $user])
    <div class="container mx-auto pt-8 space-y-4">
        <div class="flex flex-col px-4 bg-gray-300">
            <h2 class="font-bold uppercase text-2xl">{{__('global.featured')}}</h2>
            carousel met de uitgelichte advertenties (max 5 ofz )
        </div>
        <div class="flex px-4 bg-slate-800 space-x-4">
            <div class="bg-red-100 w-1/4 rounded">
                Hier komen de filters
            </div>
            <div class="bg-red-200 flex-1">
                Hier komen de advertenties
            </div>
        </div>
    </div>
@endsection