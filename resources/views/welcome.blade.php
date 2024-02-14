@extends('layouts.app')

@section('content')

    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>
    Welkom, {{ Auth::user()->name }}

@endsection