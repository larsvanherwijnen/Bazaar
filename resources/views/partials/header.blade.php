<div class="bg-gray-100">
    <div class="container mx-auto">
        <div class="flex justify-between p-4 items-center">
            <div>
                <a href="{{route('home')}}">
                    <h1 class="font-bold text-xl">De Bazaar</h1>
                </a>
            </div>
            <form method="POST" action="{{ route('changeLanguage') }}" class="inline-block">
                @csrf
                <select name="language" onchange="this.form.submit()" class="bg-white shadow appearance-none border rounded py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="nl" {{ app()->getLocale() === 'nl' ? 'selected' : '' }}>{{__('global.dutch')}}</option>
                    <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>{{__('global.english')}}</option>
                </select>
            </form>
            <div class="flex space-x-4 items-center">
                @if(Auth::check())
                    <div x-data="{open: false}" @click="open = ! open">
                        <a class="text-sm"><i class="fa fa-user mr-2"></i>{{ Auth::user()->name }}<i class="fa fa-chevron-down ml-2"></i></a>
                        <div x-show="open" x-transition class="absolute bg-white shadow-lg rounded mt-3 z-10 flex flex-col">
                            <a href="{{ route('my-account.favorites')}}" class="text-sm hover:bg-gray-200 p-2"><i class="fa fa-cog mr-2"></i>{{ __('advert.favorites') }}</a>
                            <a href="{{ route('my-account.adverts.index')}}" class="text-sm hover:bg-gray-200 p-2"><i class="fa fa-cog mr-2"></i>{{ __('global.my_adverts') }}</a>
                            <a href="{{ route('my-account.settings')}}" class="text-sm hover:bg-gray-200 p-2"><i class="fa fa-cog mr-2"></i>{{ __('global.settings') }}</a>
                            <a href="{{ route('logout')}}" class="text-sm hover:bg-gray-200 p-2"><i class="fa fa-right-from-bracket mr-2"></i>{{ __('auth.logout') }}</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login')}}" class="text-sm"><i class="fa fa-user mr-2"></i>{{ __('auth.login') }}
                    </a>
                @endif
                <a href="{{ route('my-account.adverts.create') }}" class="bg-blue-400 rounded p-2 text-sm"><i class="fa-solid fa-thumbtack mr-2"></i>{{ __('global.advertise') }}</a>
            </div>
        </div>
    </div>
</div>
