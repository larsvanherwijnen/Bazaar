@extends('layouts.app')
@section('content')

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">There were some errors with your submission.</span>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex justify-center mt-20">
        <div class="bg-white p-10 rounded shadow-md w-1/3">
            <h1 class="text-2xl mb-6 text-center">Create Advert</h1>
            <form method="post" action="{{ route('advert.store') }}" enctype="multipart/form-data" class="space-y-4" x-data="{ advertType: 'default' }">
                @csrf
                <input type="hidden" id="type" name="type" x-model="advertType">

                <div class="flex items-center space-x-4">
                    <div class="w-1/3 bg-gray-200 rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': advertType === 'Sale'}"
                         @click="advertType = 'Sale'">
                        <i class="fa-solid fa-tag text-2xl"></i>
                        <div class="flex flex-col text-center">
                            <span>Sale</span>
                        </div>
                    </div>
                    <div class="w-1/3 bg-gray-200  rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': advertType === 'Auction'}"
                         @click="advertType = 'Auction'">
                        <i class="fa-solid fa-gavel text-2xl"></i>
                        <div class="flex flex-col text-center">
                            <span>Auction</span>
                        </div>
                    </div>
                    <div class="w-1/3 bg-gray-200 rounded flex flex-col items-center py-3"
                         :class="{ 'border-2 border-blue-500': advertType === 'Bidding'}"
                         @click="advertType = 'Bidding'">
                        <i class="fa-solid fa-building text-2xl"></i>
                        <div class="flex flex-col text-center">
                            <span>Bidding</span>
                        </div>
                    </div>
                </div>
                <div class="border-b-2 border-gray-500"></div>
                <div>
                    @error('title')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                    <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
                    <input type="text" id="title" name="title" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    @error('description')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                    <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
                    <textarea id="description" name="description" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                </div>
                <div>
                    @error('images.*')
                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                    @enderror
                    <label for="images" class="block text-sm font-medium text-gray-700">Images:</label>
                    <input type="file" id="images" name="images[]" multiple class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <div id="file-names"></div>
                </div>

                <div class="border-b-2 border-gray-500"> </div>

                <div x-show="advertType === 'Sale'">
                    <div>
                        @error('price')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <label for="price" class="block text-sm font-medium text-gray-700">Price:</label>
                        <input type="number" id="price" name="price" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>                </div>
                <div x-show="advertType === 'Auction'">
                    <div>
                        @error('starting_price')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <label for="starting_price" class="block text-sm font-medium text-gray-700">Starting Price:</label>
                        <input type="number" id="starting_price" name="starting_price" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        @error('start_date')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                        <input type="datetime-local" id="start_date" name="start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        @error('end_date')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                        <input type="datetime-local" id="end_date" name="end_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div x-show="advertType === 'Bidding'">
                    <div>
                        @error('starting_price')
                        <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                        @enderror
                        <label for="starting_price" class="block text-sm font-medium text-gray-700">Starting Price:</label>
                        <input type="number" id="starting_price" name="starting_price" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div>
                    <input type="submit" value="Submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                </div>
            </form>
        </div>
    </div>
@endsection