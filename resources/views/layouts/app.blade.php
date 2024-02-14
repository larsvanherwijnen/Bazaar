<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite('resources/css/app.css')
</head>
<body>
    <nav class="bg-gray-200">
        <ul class="flex space-x-4">
            <li class="hover:bg-gray-300">
                <a class="nav-link block p-6 text-gray-800 text-lg" href="/">Home</a>
            </li>
            <li class="hover:bg-gray-300">
                <a class="nav-link block p-6 text-gray-800 text-lg" href="/example1">Example 1</a>
            </li>
            <li class="hover:bg-gray-300">
                <a class="nav-link block p-6 text-gray-800 text-lg" href="/example2">Example 2</a>
            </li>
        </ul>
    </nav>

    @yield('content')
    @vite('resources/js/app.js')
</body>
</html>