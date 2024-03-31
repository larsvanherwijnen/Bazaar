<div dusk="advert-card" class="mx-auto rounded-md border border-gray-100 text-gray-600 shadow-md bg-white">
    <div class="relative flex h-full flex-col text-gray-600 md:flex-row">
        <div class="mx-auto flex items-center px-3  md:py-6">
            <img class="block h-80 max-w-full rounded-md shadow-lg"
                 src="{{ $advert->advertImages->first() ? Storage::url('images/' . $advert->advertImages->first()->path) : Storage::url('images/img.png') }}"
                 alt="Shop image"/>
        </div>
        <div class="flex py-6 md:w-4/6 space-x-4">
            <div class="flex w-3/4 justify-between px-2">
                <div>
                    <a class="mb-2 text-2xl font-black" href="{{route('adverts.show', $advert)}}">{{$advert->title}}</a>
                    <p class="mt-3 font-sans text-base tracking-normal">{{$advert->description}}.</p>
                </div>
                <span>€{{ number_format($advert->price, 2, ',', '.') }}</span>
            </div>
            <div class="w-1/4">
                <a class="mb-2 text-blue-700" href="{{route('profile', $advert->user->url)}}">{{$advert->user->name}}</a>
            </div>
        </div>
    </div>
</div>
