<div class="flex container mx-auto pt-8">
    <div class="w-full">
        @if($user->type->isBusiness())
            <div class="relative">
                <img src="{{ $user->company->config ? Storage::url($user->company->config->get('banner'))  : "https://placehold.co/400?text=Banner" }}"
                     alt=""
                     class="h-72 lg:h-96 w-full object-cover">
                <div class="absolute bottom-8 left-12 flex space-x-4 text-white">
                    <img src="{{ $user->company->config ? Storage::url($user->company->config->get('logo'))  : "https://placehold.co/400/orange/white?text=Logo" }}"
                         alt="" class="h-32 lg:h-44">
                    <div class="flex flex-col justify-end">
                        <p class="font-semibold text-2xl">{{ $user->company->name }}</p>
                        <p class="items-end">{{ $user->company->config?->get('description') ?? "test" }}</p>
                    </div>
                </div>
                <div class="absolute top-4 right-4 bg-gray-300 opacity-75 hover:opacity-100 rounded w-8 h-8 flex justify-center items-center {{$user == Auth::user() ? "" : "hidden" }}">
                    <a href="{{route('my-account.settings')}}"><i class="fa-solid fa-pencil z-10 text-sm"></i></a>
                </div>
            </div>
            <div class="p-5 bg-white rounded-b">
                reviews and stuff
            </div>
        @else
            <div class="p-5 bg-slate-800 text-white rounded-t">
                <p class="font-bold text-3xl">{{ $user->name }}</p>
            </div>
            <div class="p-5 bg-white rounded-b">
                reviews and stuff
            </div>
        @endif
    </div>
</div>