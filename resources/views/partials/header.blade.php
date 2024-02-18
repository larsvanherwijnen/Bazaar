<div class="bg-gray-100">
    <div class="w-1/2 mx-auto">
        <div class="flex justify-between p-4 items-center">
            <div>
                <h1 class="font-bold text-xl">De Bazaar</h1>
            </div>
            <div class="flex space-x-4 items-center">
                @if(Auth::check())
                    <div x-data="{open: false}" @click="open = ! open">
                        <a class="text-sm"><i class="fa fa-user mr-2"></i>{{ Auth::user()->name }}<i class="fa fa-chevron-down ml-2"></i></a>
                        <div x-show="open" x-transition class="absolute bg-white shadow-lg rounded p-2 mt-3 z-10">
                            <a href="{{ route('logout')}}" class="text-sm"><i class="fa fa-right-from-bracket mr-2"></i>{{ __('auth.logout') }}</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login')}}" class="text-sm"><i class="fa fa-user mr-2"></i>{{ __('auth.login') }}
                    </a>
                @endif
                <a href="" class="bg-blue-400 rounded p-2 text-sm"><i class="fa-solid fa-thumbtack mr-2"></i>{{ __('global.advertise') }}</a>
            </div>
        </div>
    </div>
</div>
