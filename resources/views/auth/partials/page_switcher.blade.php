<div class="border-b-2 border-gray-500 items-center justify-center flex space-x-4 pb-4">
    <a href="{{ route('login') }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ request()->is('login') ? 'border-black font-semibold' : 'text-gray-400 hover:text-black  hover:border-black' }}">{{ __('auth.login') }}</a>
    <a href="{{ route('register') }}" class="inline-block p-4 border-b-2 rounded-t-lg {{ request()->is('register') ? 'border-black font-semibold' : 'text-gray-400 hover:text-black  hover:border-black' }}">{{ __('registration.register') }}</a>
</div>