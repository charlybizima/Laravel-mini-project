<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Library Management System</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <div class="flex flex-col items-center">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-8">Welcome to Library Management System</h1>
                    
                    @if (Route::has('login'))
                        <div class="space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-6 py-2 bg-gray-700 text-white font-semibold rounded-md hover:bg-gray-800">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="px-6 py-2 bg-gray-700 text-black font-semibold rounded-md hover:bg-gray-800">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-6 py-2 bg-gray-700 text-black font-semibold rounded-md hover:bg-gray-800">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
