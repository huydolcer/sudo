<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/style.css'])
</head>
<body>
    <div class="container mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-4">Xác minh email của bạn</h1>
        <p class="text-gray-600 text-center mb-6">Vui lòng kiểm tra email của bạn để xác minh tài khoản.</p>
        <form method="POST" action="{{ route('verification.send') }}" class="flex justify-center">
            @csrf
            <button type="submit" class="bg-sky-600 text-white px-6 py-2 rounded hover:bg-sky-700 transition duration-300">Gửi lại email xác minh</button>
        </form>
    </div>
</body>
</html>