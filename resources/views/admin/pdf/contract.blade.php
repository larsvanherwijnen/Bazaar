<html lang="en">
<head>
    <title>Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="px-2 py-8 max-w-xl mx-auto">
    <div class="flex items-center justify-between mb-4">
        <div class="flex flex-col">
            <div class="text-gray-700 font-semibold text-lg">Bazaar</div>
            <div class="font-bold text-xl mb-2 uppercase">{{ __('global.contract') }} - {{ $company->name }}</div>
            <div class="text-sm">{{__('global.date')}}: {{ Date::now()->format('F j, Y') }}</div>
        </div>
    </div>
    <div class="border-b-2 border-gray-300 pb-8 mb-8 space-y-4">
        <div>
            <span class="font-bold mb-2">Lorem ipsum dolor sit amet.</span>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget erat et nisl euismod viverra. Praesent et quam quis nisl egestas imperdiet. Quisque euismod in erat mollis vulputate. Fusce porttitor augue a ornare pharetra. Ut bibendum nisi non pharetra vulputate. Morbi varius consectetur aliquet. Donec sed neque blandit, semper magna et, semper augue. Quisque quis interdum eros. Suspendisse in scelerisque enim. Integer pharetra scelerisque purus, egestas iaculis risus egestas ullamcorper.</p>
        </div>
        <div>
            <span class="font-bold mb-2">Lorem ipsum dolor sit amet.</span>
            <p>Curabitur suscipit sagittis tellus, eget consequat sem imperdiet nec. Phasellus tristique leo ut ante elementum, nec hendrerit felis ultrices. Vivamus in imperdiet eros. Aenean efficitur, mauris ac bibendum sollicitudin, erat nisi accumsan augue, in fermentum leo sem commodo ante. Nulla gravida luctus mauris ullamcorper tristique. Aliquam et aliquet nunc. Proin auctor elementum dui, ac rutrum leo laoreet vitae. Nam at nibh dui.</p>
        </div>
        <div>
            <span class="font-bold mb-2">Lorem ipsum dolor sit amet.</span>
            <p>Vivamus pretium laoreet porta. Cras hendrerit sapien non facilisis rhoncus. Donec eget suscipit lorem. Nulla porta porta ligula, eu euismod ex sagittis ac. Phasellus eget magna id orci auctor malesuada sed non tortor. Curabitur fringilla sagittis velit, non laoreet nisl scelerisque at. Cras tristique vestibulum interdum. Suspendisse aliquet turpis ligula, id scelerisque sapien porttitor a. Morbi nec ante lectus. Aenean mattis turpis vel diam facilisis, et sollicitudin est porttitor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Morbi eu neque velit. In ex odio, euismod vitae dapibus ac, rutrum ut magna. Maecenas hendrerit, ligula sit amet sollicitudin tempus, magna turpis varius enim, sit amet sagittis erat diam id lorem. Mauris efficitur nunc tempus lobortis commodo.</p>
        </div>
    </div>

    <div class="flex justify-between">
        <div class="flex flex-col border-b-2 border-gray-300 h-24 w-32">
            <div class="text-gray-700 font-semibold text-lg">Bazaar</div>
        </div>
        <div class="flex flex-col border-b-2 border-gray-300 h-24 w-32">
            <div class="text-gray-700 font-semibold text-lg">{{ $company->name }}</div>
        </div>
    </div>
</div>

</body>
</html>