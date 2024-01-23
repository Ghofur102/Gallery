<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=UnifrakturCook:wght@700&display=swap" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: #E7AB79 !important;
            border-color: #E7AB79 !important;
        }

        .text-primary {
            color: #4C3A51 !important;
        }

        .dropdown-item:active {
            background-color: #4C3A51 !important;
        }

        .text-love {
            color: red;
        }


    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <h1>
                    <a class="navbar-brand" style="font-family: UnifrakturCook;font-size: 32px;color:black;"
                        href="{{ url('/') }}">
                        Gall
                    </a>
                </h1>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item my-auto">
                            <a class="nav-link {{ request()->is('/') ? 'text-black' : 'text-primary' }}"
                                href="/"><b>Home</b></a>
                        </li>
                        <li class="nav-item my-auto">
                            <a class="nav-link {{ request()->is('gallery') ? 'text-black' : 'text-primary' }}"
                                href="/gallery"><b>Gallery</b></a>
                        </li>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item my-auto py-2">
                                    <a class="btn btn-primary btn-sm mx-1"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item my-auto py-2">
                                    <a class="btn btn-primary btn-sm mx-1"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @guest
                                        <img src="{{ asset('profile-default.png') }}"
                                            style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                            alt="">
                                    @else
                                        @if (Auth::user()->foto_profil != null)
                                            <img src="{{ asset('storage/' . Auth::user()->foto_profil) }}"
                                                style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                alt="">
                                        @else
                                            <img src="{{ asset('profile-default.png') }}"
                                                style="width: 50px;height: 50px; object-fit:cover;border-radius:50%;"
                                                alt="">
                                        @endif
                                    @endguest
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/profile">Profile Anda</a>
                                    <a class="dropdown-item" href="/postingan-anda">Postingan Anda</a>
                                    <a class="dropdown-item" href="/album">Album</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
