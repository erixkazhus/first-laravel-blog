<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sports news') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
                    <header class="bg-gray-800 py-6">
                    <div class="container mx-auto flex justify-between items-center px-6">
                        <div class="flex-shrink-0">
                            <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                                {{ config('app.name', 'Sports news') }}
                            </a>
                        </div>
                        <nav class="flex items-center space-x-4 text-gray-300 text-sm sm:text-base">
                            <a class="no-underline hover:underline" href="/">Home</a>
                            <a class="no-underline hover:underline" href="/blog">Blog</a>
                            <!-- Search Form -->
                            <form action="{{ route('search') }}" method="GET" class="flex items-center">
                                <input type="text" name="query" placeholder="Search..." class="px-2 py-1 border rounded-sm text-xs">
                                <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded-sm text-xs">Search</button>
                            </form>
                            @guest
                                <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <span>{{ Auth::user()->name }}</span>

                                <a href="{{ route('logout') }}"
                                class="no-underline hover:underline"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    {{ csrf_field() }}
                                </form>
                            @endguest
                        </nav>
                    </div>
                </header>
            <div>
                @yield('content')
            </div>
        <div>
            @include('layouts.footer')
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#categories').select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });
    </script>
</body>
</html>
