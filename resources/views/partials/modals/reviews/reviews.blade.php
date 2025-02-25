<div x-show="openModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Reviews
                        </h3>
                        <div class="mt-2">
                            @foreach($reviews as $review)
                                <div class="border-b border-gray-200 py-4 flex justify-between">
                                    <div class="w-full">
                                        <p><strong>{{ $review->reviewer->name }}</strong></p>
                                        <p class="w-96 overflow-hidden max-h-24 whitespace-normal">{{ $review->comment }}</p>
                                        <div>
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <span class="text-yellow-500">&#9733;</span>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500 text-right">{{ $review->created_at->format('M d, Y') }}</p>
                                        @if(auth()->check() && auth()->id() == $review->reviewer_id)
                                            <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="mt-3 w-full inline-flex justify-center sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                    <i class="fa-solid fa-trash-can text-red-500"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button @click="openModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>