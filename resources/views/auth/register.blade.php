@extends('layouts.login')

@section('content')
    <div class="h-screen flex flex-col items-center justify-center">
        <h1 class="text-3xl font-bold mb-10">{{ __('registration.register') }}</h1>
        <div x-data="{ accountType: '{{ old('account_type', 'private_without_advertising') }}' }"
             class="bg-white shadow-2xl w-3/5 p-4 rounded space-y-4">
            @include('auth.partials.page_switcher')
            <h1 class="text-2xl font-bold">{{ __('registration.account_type') }}</h1>
            <span class="text-sm">{{ __('registration.account_type_explanation') }}</span>
            <form method="POST" action="{{ route('register') }}" class="w-full space-y-4">
                @csrf
                <div class="flex items-center space-x-4">
                    <div class="w-1/3 bg-gray-200 rounded flex flex-col items-center py-3 "
                         :class="{ 'border-2 border-blue-500': accountType === 'private_without_advertising'}">
                        <input type="checkbox" id="private_without_advertising" name="account_type"
                               value="private_without_advertising" class="hidden"
                               @click="accountType = 'private_without_advertising'">
                        <label for="private_without_advertising" class="flex flex-col text-center">
                            <i class="fa-solid fa-user text-2xl"></i>
                            <span>{{ __('registration.private') }}</span>
                            <span class="text-xs">{{ __('registration.private_without_advertising') }}</span>
                        </label>
                    </div>
                    <div class="w-1/3 bg-gray-200 rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': accountType === 'private_with_advertising'}">
                        <input type="checkbox" id="private_with_advertising" name="account_type"
                               value="private_with_advertising" class="hidden"
                               @click="accountType = 'private_with_advertising'">
                        <label for="private_with_advertising" class="flex flex-col text-center">
                            <i class="fa-solid fa-user text-2xl"></i>
                            <span>{{ __('registration.private') }}</span>
                            <span class="text-xs">{{ __('registration.private_with_advertising') }}</span>
                        </label>
                    </div>
                    <div class="w-1/3 bg-gray-200 rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': accountType === 'business'}">
                        <input type="checkbox" id="business" name="account_type" value="business" class="hidden"
                               @click="accountType = 'business'">
                        <label for="business" class="flex flex-col text-center">
                            <i class="fa-solid fa-building text-2xl"></i>
                            <span>{{ __('registration.business') }}</span>
                            <span class="text-xs">{{ __('registration.business_explanation') }}</span>
                        </label>
                    </div>
                </div>

                <div class="border-b-2 border-gray-500">
                </div>
                {{ __('registration.account_information') }}

                <div class="flex w-full space-x-4">
                    <div class="mb-5 flex flex-1 flex-col">
                        <label for="name"
                               class="block mb-2 text-sm font-medium">{{ __('registration.username') }}</label>
                        <input type="text" id="name" name="username"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                               value="{{old('username')}}">
                        @error('username')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5 flex flex-1 flex-col">
                        <label for="email" class="block mb-2 text-sm font-medium">{{__('registration.email') }}</label>
                        <input type="email" id="email" name="email"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                               value="{{old('email')}}">
                        @error('email')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex w-full space-x-4">
                    <div class="mb-5 w-1/2 flex flex-col">
                        <label for="password"
                               class="block mb-2 text-sm font-medium">{{__('registration.password') }}</label>
                        <input type="password" id="password" name="password"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        @error('password')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-5 w-1/2 flex flex-col">
                        <label for="password_confirmation"
                               class="block mb-2 text-sm font-medium">{{__('registration.confirm_password') }}</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        @error('password_confirmation')
                        <span class="text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div x-show="accountType === 'business'" x-data="{ companyName: '', customURL: '' }"
                     class="border-t-2 border-gray-500">
                    {{__('registration.business_information') }}
                    <div class="flex w-full space-x-4">
                        <div class="mb-5 w-1/2 flex flex-col">
                            <label for="companyName"
                                   class="block mb-2 text-sm font-medium">{{ __('registration.company_name') }}</label>
                            <input type="text" id="companyName" name="companyName" x-model="companyName"
                                   @input="customURL = companyName.toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                   value="{{old('companyName')}}">
                            @error('companyName')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-5 w-1/2 flex flex-col">
                            <label for="kvk" class="block mb-2 text-sm font-medium">{{__('registration.kvk') }}</label>
                            <input type="text" id="kvk" name="kvk"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                   value="{{old('kvk')}}">
                            @error('kvk')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex w-full space-x-4">
                        <div class="mb-5 w-1/2 flex flex-col">
                            <label for="name" class="block mb-2 text-sm font-medium">{{__('registration.url') }}</label>
                            <div class="flex">
                                <span class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-l-lg flex items-center px-3 whitespace-no-wrap"
                                      x-data="{hostname: window.location.hostname + '/'}" x-text="hostname"></span>
                                <input type="text" id="url" name="url" x-model="customURL"
                                       @input.debounce.400ms="customURL = customURL.toLowerCase().replace(/[^a-z0-9]/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')"
                                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-r-lg block w-full p-2.5"
                                       value="{{old('url')}}">
                            </div>
                            @error('url')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="rounded px-3 py-2  bg-green-200">
                        Register
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection


