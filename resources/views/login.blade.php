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
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
            <form action="{{ route('login-auth') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
                    </div>
                </div>
                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
                </div>
            </form>
            <div class="mt-6">
                <a href="{{ url('login/google') }}" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21.35 11.1h-9.9v2.8h5.7c-.3 1.8-1.5 3.3-3.2 4.1v3.4h5.2c3-2.7 4.8-6.7 4.8-11.3 0-.7-.1-1.4-.2-2.1h-2.4z" fill="#4285F4"/>
                        <path d="M12 22c2.4 0 4.4-.8 5.9-2.1l-2.8-2.1c-.8.5-1.8.8-3.1.8-2.4 0-4.4-1.6-5.1-3.8H3.9v2.4C5.4 19.8 8.5 22 12 22z" fill="#34A853"/>
                        <path d="M6.9 13.8c-.2-.5-.3-1-.3-1.6s.1-1.1.3-1.6V8.2H3.9C3.3 9.4 3 10.7 3 12s.3 2.6.9 3.8l3-2z" fill="#FBBC05"/>
                        <path d="M12 4.8c1.3 0 2.5.4 3.4 1.2l2.5-2.5C16.4 2.1 14.4 1.2 12 1.2 8.5 1.2 5.4 3.4 3.9 6.2l3 2c.7-2.2 2.7-3.4 5.1-3.4z" fill="#EA4335"/>
                    </svg>
                    Login with Google
                </a>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('direction-regisn') }}" class="text-sm text-indigo-600 hover:text-indigo-500">Don't have an account? Sign up</a>
            </div>
        </div>
    </div>
</body>
</html>
