<div class="lg:col-span-3">
    <div class="border-b border-gray-300">
        <nav class="flex gap-4">
            <a href="#" title=""
               class="border-b-2 border-gray-900 py-4 text-sm font-medium text-gray-900 hover:border-gray-400 hover:text-gray-800">
                {{__('global.related_adverts')}} </a>
        </nav>
    </div>

    <div class="mt-8 sm:mt-12 flex space-x-4">
        @foreach($advert->relatedAdverts as $relatedAdvert)
            @include('partials.advert_card_small', ['advert' => $relatedAdvert])
        @endforeach
    </div>
</div>