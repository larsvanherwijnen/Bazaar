@extends('layouts.app')

@section('content')
    @include('partials.user_header', ['user' => $user])

    <div class="flex w-1/2 mx-auto pt-8 px-4">
        Hier moeten de advertenties van de gebruiker komen
    </div>
@endsection