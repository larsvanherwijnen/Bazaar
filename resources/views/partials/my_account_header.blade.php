<div class="bg-gray-200">
    <div class="flex w-1/2 mx-auto pt-8 px-4">
        <div class="flex flex-col">
            <h1 class="font-bold text-3xl mb-4">{{ __('global.my_bazaar') }}</h1>
            <div class="text-sm font-medium text-center text-gray-500">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg ">Profile</a>
                    </li>
                    <li class="me-2">
                        <a href="{{ route('my-account.settings')}}" class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300  @if(request()->routeIs('my-account.settings')) text-blue-600 border-blue-600 @endif">Dashboard</a>
                    </li>
                    <li class="me-2">
                        <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Settings</a>
                    </li>
                    <li class="me-2">
                        <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">Contacts</a>
                    </li>
                    <li>
                        <a class="inline-block p-4 text-gray-400 rounded-t-lg cursor-not-allowed dark:text-gray-500">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>