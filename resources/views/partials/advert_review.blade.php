<div class="p-5 bg-white rounded-b mt-5">
    <div class="flex flex-col items-center space-y-4">
        <div class="flex items-center space-x-2">
            @for ($i = 0; $i < 5; $i++)
                @if (floor($averageRatingRental) - $i >= 1)
                    <i class="fas fa-star text-yellow-400"></i>
                @elseif ($averageRatingRental - $i > 0)
                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                @else
                    <i class="far fa-star text-gray-300"></i>
                @endif
            @endfor
            <p class="text-gray-600">{{ $reviewsCountRental }} {{ __('global.reviews') }}</p>
        </div>
        <div class="flex space-x-4">
            @if($showReviewCreateButton)
                <div x-data="{openModal: false}">
                    <button
                            @click="openModal = true"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-300 focus:outline-none"
                            aria-label="Create Review"
                    >
                        {{__('global.create_review')}}
                    </button>
                    @include('partials.modals.reviews.create')
                </div>
            @endif
            @if($showReviewButton)
                <div x-data="{openModal: false}">
                    <button
                            @click="openModal = true"
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition duration-300 focus:outline-none"
                            aria-label="View Reviews"
                    >
                        {{__('global.view_reviews')}}
                    </button>
                    @include('partials.modals.reviews.reviews')
                </div>
            @endif
        </div>
    </div>
</div>