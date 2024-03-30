@extends('layouts.app')

@section('content')
    @include('partials.search')
    <div class="container mx-auto pt-8 space-y-4">
        <livewire:adverts :search="$search"/>
    </div>
@endsection