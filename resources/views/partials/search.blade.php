<div class="bg-gray-200">
    <form action="{{route('adverts.index')}}" method="GET">
        <div class="flex w-1/2 mx-auto p-4">
            <select name="" id="" class="bg-gray-50 text-gray-900 text-sm rounded-l-lg block w-1/3  p-2.5">
                <option value="test">{{ __('global.all')}}</option>
            </select>
            <div class="relative w-full">
                <i class="absolute fa fa-search text-gray-400 right-4 top-3"></i>
                <input dusk="search" type="text" placeholder="{{ __('global.search')}}...." id="url" name="search" value="{{ request()->query('search') }}"
                       class="bg-gray-50 text-gray-900 text-sm rounded-r-lg block w-full p-2.5">
            </div>
        </div>
    </form>
</div>