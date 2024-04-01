@extends('layouts.login')

@section('content')
    <div class="h-screen flex flex-col items-center justify-center">
        <h1 class="text-3xl font-bold mb-4">{{ __('auth.login') }}</h1>
        <div class="bg-white shadow-2xl w-1/3 p-4 rounded space-y-4">
            @include('auth.partials.page_switcher')
            <form method="POST" action="{{ route('login') }}" class="w-full space-y-4">
                @csrf
                <input type="hidden" name="account_type" x-model="accountType">
                <div class="flex flex-col w-full">
                    <div class="mb-5 flex flex-1 flex-col">
                        <label for="email" class="block mb-2 text-sm font-medium">{{__('registration.email') }}</label>
                        <input type="email" id="email" name="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                               value="{{old('email')}}">
                        @error('email')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5 flex flex-1 flex-col">
                        <label for="password" class="block mb-2 text-sm font-medium">{{__('registration.password') }}</label>
                        <input type="password" id="password" name="password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <button type="submit" id="login" class="rounded px-3 py-2  bg-green-200">
                        {{__('auth.login') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection


