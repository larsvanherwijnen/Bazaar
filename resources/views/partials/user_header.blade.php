<div class="flex container mx-auto pt-8">
    <div class="w-full">
        @if($user->type->isBusiness())
            <div class="relative">
                <img src="{{ $user->company->config ? Storage::url($user->company->config->get('banner')) : 'https://placehold.co/400?text=Banner' }}"
                     alt=""
                     class="h-72 lg:h-96 w-full object-cover">
                <div class="absolute bottom-8 left-12 flex space-x-4 text-white">
                    <img src="{{ $user->company->config ? Storage::url($user->company->config->get('logo')) : 'https://placehold.co/400/orange/white?text=Logo' }}"
                         alt="" class="h-32 lg:h-44">
                    <div class="flex flex-col justify-end">
                        <p class="font-semibold text-2xl">{{ $user->company->name }}</p>
                        <p class="items-end">{{ $user->company->config?->get('description') ?? 'test' }}</p>
                    </div>
                </div>
                <div class="absolute top-4 right-4 bg-gray-300 opacity-75 hover:opacity-100 rounded w-8 h-8 flex justify-center items-center {{ $user == Auth::user() ? '' : 'hidden' }}">
                    <a href="{{ route('my-account.settings') }}"><i class="fa-solid fa-pencil z-10 text-sm"></i></a>
                </div>
            </div>
        @else
            <div class="p-5 bg-slate-800 text-white rounded-t">
                <p class="font-bold text-3xl">{{ $user->name }}</p>
            </div>
        @endif
        <div class="p-5 bg-white rounded-b">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    @for ($i = 0; $i < 5; $i++)
                        @if (floor($averageRating) - $i >= 1)
                            <i class="fas fa-star text-yellow-400"></i>
                        @elseif ($averageRating - $i > 0)
                            <i class="fas fa-star-half-alt text-yellow-400"></i>
                        @else
                            <i class="far fa-star text-gray-300"></i>
                        @endif
                    @endfor
                    <p class="text-gray-600">{{ $reviewsCount }} {{ __('global.reviews') }}</p>
                </div>
                <div class="flex space-x-4">
                    @if($showCreateButton)
                        <div x-data="{openModal: false}">
                            @vite('resources/js/rating.js')
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
                    @if($reviews->count() > 0)
                        <div x-data="{openModal: false}">
                            @vite('resources/js/rating.js')
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
    </div>
</div>