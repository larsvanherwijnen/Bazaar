@extends('layouts.admin')

@section('content')
    <div class="flex h-screen bg-gray-200">
        <!-- Sidebar / Menu -->
        <div class="bg-white w-64 flex flex-col">
            <ul class="flex-1 px-4 space-y-2 overflow-y-auto">
                <li><a href="{{ route('admin.dashboard') }}" class="block px-2 py-1 text-gray-900 rounded hover:bg-blue-500 hover:text-white">{{ __('global.dashboard') }}</a></li>
                <li><a href="{{ route('admin.contracts') }}" class="block px-2 py-1 text-gray-900 rounded hover:bg-blue-500 hover:text-white">{{ __('global.contracts') }}</a></li>
                <!-- Add more items as needed -->
            </ul>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <main class="flex-1 p-4 overflow-y-auto">
                <!-- Main content goes here -->
            </main>
        </div>
    </div>
@endsection