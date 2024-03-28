<div class="flex flex-col space-y-4">
        <div class="flex flex-col">
                <span class="text-xl font-bold text-gray-900">{{ __('advert.bidding') }}</span>
                @if($advert->type == \App\Enum\AdvertType::BIDDING)
                        <span class="text-sm text-gray-500">{{ __('advert.from', ['start_price' => $advert->starting_price]) }}</span>
                @endif
        </div>
    @if($advert->type == \App\Enum\AdvertType::AUCTION)
        <div class="flex flex-col items-center justify-between space-y-4  py-4 sm:flex-row sm:space-y-0">
            @php
                $endDate = new DateTime($advert->end_date);
                $now = new DateTime();
                $interval = $now->diff($endDate);
                $daysRemaining = $interval->days;
            @endphp

            @if ($daysRemaining > 1)
                <span>Ends in {{$daysRemaining}} days</span>
            @elseif ($daysRemaining == 1)
                <span>Ends in 1 day</span>
            @elseif ($now < $endDate)
                <span>Ending soon</span>
            @else
                <span>Verlopen</span>
            @endif
        </div>
    @endif

    @if($advert->type == \App\Enum\AdvertType::AUCTION || $advert->type == \App\Enum\AdvertType::BIDDING)
    @endif
</div>
