<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
<div id="app" style="display: flex; min-height: 100vh; flex-direction: column">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="height: 55px">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ secure_asset('favicon-96x96.png') }}" width="30" height="30" alt="icon">
                {{ config('app.name', 'PortfolioBlog') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @if(session()->has('success'))
        <div class="card">
            <div class="card-body">
                <div class="card-text">{{ session()->get('success') }}</div>
            </div>
        </div>
    @endif

    <main class="py-4" style="flex: 1">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        <div class="container-fluid">
            <div class="row">
                @auth
                    <div class="col-lg-3">
                        <div class="card mb-3">
                            <span class="badge badge-success rounded-0">Online</span>
                            <div class="card-body d-flex align-items-center">
                                <form action="{{ route('update_avatar') }}" id="updateAvaForm" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input onchange="document.getElementById('updateAvaForm').submit()"
                                           class="d-none"
                                           id="updateAvaInpt"
                                           type="file"
                                           name="avatar">
                                </form>
                                <img src="{{ secure_asset('storage/uploads/' . Auth::user()->avatar) }}" alt="avatar"
                                     class="cover mx-3 pointer rounded-circle"
                                     width="42"
                                     height="42"
                                     onclick="document.getElementById('updateAvaInpt').click()">
                                <h3 class="m-0 card-title">{{ Auth::user()->name }}</h3>
                            </div>
                            <div class="list-group">
                                <a href="{{ route('home') }}"
                                   class="list-group-item list-group-item-action rounded-0">@lang('.main_page')</a>
                                <a href="{{ route('profile') }}"
                                   class="list-group-item list-group-item-action rounded-0">@lang('.profile')</a>
                                <a href="{{ route('new_blog') }}"
                                   class="list-group-item list-group-item-action rounded-0">@lang('.create_blog')</a>
                                <a href="#" class="list-group-item list-group-item-action rounded-0"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">@lang('.logout')</a>
                            </div>
                        </div>
                    </div>
                @endauth

                {{-- For pretty UI--}}
                @auth
                    <div class="@auth col-lg-9 @else col-lg @endauth">
                        @yield('content')
                    </div>
                @else
                    <div class="container">
                        <div class="@auth col-lg-9 @else col-lg @endauth">
                            @yield('content')
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </main>

    <footer class="bg-secondary p-3" style="height: 55px;">
        <span class="text-white">{{ env('APP_NAME') }}. Copyright {{ \Carbon\Carbon::now()->year }}</span>
    </footer>
</div>
</body>
</html>
