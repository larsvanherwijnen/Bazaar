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
                            @if(!$user->contract)
                                <a href="{{ route('admin.contracts.export', $user) }}"
                                   class="bg-blue-500 text-white px-3 py-2 rounded-lg">Export contract</a>
                                <a @click="uploadOpen = true"
                                   class="bg-blue-500 text-white px-3 py-2 rounded-lg">{{ __('global.upload_contract') }}</a>
                            @elseif($user->contract->approved_at === null)
                                <a @click="contractOpen = true"
                                   class="bg-green-500 text-white px-3 py-2 rounded-lg">{{ __('global.approve_contract') }}</a>
                            @else
                                <div class="flex space-x-4 text-center">
                                    <p>{{ __('global.contract_approved') }}  {{ $user->contract->approved_at }}</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    @include('partials.modals.upload_contract', ['users' => $users])
                    @if($user->contract)
                        @include('partials.modals.approve_contract', ['users' => $users])
                    @endif
                @endif
            </main>
        </div>
    </div>
@endsection
