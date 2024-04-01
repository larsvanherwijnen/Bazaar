@extends('layouts.admin')

@section('content')
    <div class="flex h-screen bg-gray-200" x-data="{uploadOpen: false, contractOpen: false}">
        <!-- Sidebar / Menu -->
        <div class="bg-white w-64 flex flex-col">
            <ul class="flex-1 px-4 space-y-2 overflow-y-auto">
                <li><a href="{{ route('admin.dashboard') }}"
                       class="block px-2 py-1 text-gray-900 rounded hover:bg-blue-500 hover:text-white">{{ __('global.dashboard') }}</a>
                </li>
                <li><a href="{{ route('admin.contracts') }}"
                       class="block px-2 py-1 text-gray-900 rounded hover:bg-blue-500 hover:text-white">{{ __('global.contracts') }}</a>
                </li>
                <!-- Add more items as needed -->
            </ul>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 p-4 overflow-y-auto">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <div class="bg-white rounded-lg shadow-lg p-4 mb-4">
                            <h2 class="text-xl font-semibold">{{ $user->company->name }}</h2>
                            <p>{{ $user->id }}</p>
                            @if(!$user->contract)
                                <a href="{{ route('admin.contracts.export', $user) }}"
                                   class="bg-blue-500 text-white px-3 py-2 rounded-lg">Export contract</a>
                                <form action="{{ route('admin.contracts.upload', $user) }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                                            {{ __('global.upload_contract') }}
                                        </h3>
                                        <div class="mt-5">
                                            <input type="file" name="contract" id="contract"
                                                   class="block w-full border-gray-300 rounded-md shadow-sm sm:text-sm focus:ring-green-500 focus:border-green-500"
                                                   accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="submit"
                                                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">
                                            {{ __('global.upload') }}
                                        </button>
                                    </div>
                                </form>
                            @elseif($user->contract->approved_at === null)
                                <form action="{{ route('admin.contracts.approve', $user->contract) }}" method="post">
                                    @csrf
                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5"
                                                     stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                                                </svg>
                                            </div>
                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <h3 class="text-base font-semibold leading-6 text-gray-900"
                                                    id="modal-title">{{__('global.approve_contract')}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="submit"
                                                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">
                                            {{__('global.approve_contract')}}
                                        </button>
                                        <button type="button"
                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="flex space-x-4 text-center">
                                    <p>{{ __('global.contract_approved') }}  {{ $user->contract->approved_at }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach

                @endif
            </main>
        </div>
    </div>
@endsection
