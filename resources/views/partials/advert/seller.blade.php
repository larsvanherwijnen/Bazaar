<div class="flex flex-col">
    <a class="text-blue-700" href="{{ route('profile', $advert->user->url) }}">{{$advert->user->name}}</a>
    <div class="mt-2 flex">
        <div class="flex items-center">
            @for ($i = 0; $i < 5; $i++)
                @if (floor($averageRating) - $i >= 1)
                    <i class="fas fa-star text-yellow-400"></i>
                @elseif ($averageRating - $i > 0)
                    <i class="fas fa-star-half-alt text-yellow-400"></i>
                @else
                    <i class="far fa-star text-gray-300"></i>
                @endif
            @endfor
        </div>
        <p class="ml-2 text-sm font-medium text-gray-500">{{ $reviewsCount }} {{__('global.reviews')}}</p>
    </div>
</div>