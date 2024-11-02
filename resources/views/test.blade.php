<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(Auth::check())
    <span class="cursor-pointer flex items-center hover:text-sky-600" id="uploadToggle">
        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
        <span class="hidden sm:inline ml-2">Upload</span>
    </span>
        <span class="text-gray-800">
            <a href="{{ route('profile') }}" class="hover:text-sky-600">{{ Auth::user()->name }}</a>
        </span>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-300">Đăng xuất</button>
        </form>
    @else
        
        <span class="cursor-pointer flex items-center hover:text-sky-600">
            <a href="{{ route('login') }}">
                <i class="fa-solid fa-right-to-bracket text-xl"></i>
                <span class="hidden sm:inline ml-2">Đăng nhập</span>
            </a>
        </span>
        <a href="{{ route('register') }}" class="bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-700 transition duration-300 hidden sm:block">Đăng ký</a>
    @endif
</body>
</html>