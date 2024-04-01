<div class="flex flex-col bg-white rounded" x-data="{amount: ''}">
    <form wire:submit="save" class="space-y-4">
        <div class="flex flex-col">
            <span class="text-xl font-bold text-gray-900">{{ __('advert.book') }}</span>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        <div class="flex flex-col space-y-4">
            <div>
                <label for="start" class="text-sm text-gray-500">{{ __('advert.start_date') }}</label>
                <input type="date" wire:model="start" id="start" class="border border-blue-700 rounded w-full pr-2 py-1" >
                @error('start') <span class="text-red-600">{{ $message }}</span> @enderror

            </div>
            <div>
                <label for="end" class="text-sm text-gray-500">{{ __('advert.end_date') }}</label>
                <input type="date" wire:model="end" id="end" class="border border-blue-700 rounded w-full pr-2 py-1" >
                @error('end') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
        </div>
        <button type="submit"
                class="border border-blue-700 p-2 rounded text-blue-700 w-full text-md font-semibold"><i class="fa-regular fa-calendar mr-2"></i>{{ __('advert.place_booking') }}</button>
    </form>
</div>

