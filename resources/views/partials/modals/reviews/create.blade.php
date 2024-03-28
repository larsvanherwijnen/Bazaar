<div x-show="openModal"
     class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 max-w-md mx-auto rounded-md">
        <h1 class="text-3xl font-bold mb-4">{{__('global.create_review')}}</h1>
        <form id="form1" action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="reviewer_id" value="{{ auth()->id() }}">
                <p class="text-red-500 rating-error" data-error-message="{{ __('validation.rating_error') }}">
                    @error('rating')
                    {{ $message }}
                    @enderror
                </p>
            <div class="flex items-center">
                @for ($i = 1; $i <= 5; $i++)
                    <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" class="hidden">
                    <label for="star{{ $i }}" class="text-yellow-400 cursor-pointer text-2xl">&#9734;</label>
                @endfor
            </div>
            <div>
                <label for="comment" class="block text-lg font-medium">{{__('global.comment_optional')}}</label>
                <textarea class="form-input mt-1 block w-full rounded-md" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">{{__('global.submit')}}</button>
            <button @click="openModal = false" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">{{__('global.close')}}</button>
        </form>
    </div>
</div>