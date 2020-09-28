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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <img src="{{ Storage::url('public/images/moviebase.png') }}" class="mr-1">

                <a class="navbar-brand" href="{{ url('/') }}">
                    MovieBase
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->



                    <ul class="navbar-nav mr-auto">

{{--                        <li class="nav-item">--}}
{{--                            <a href="{{route('posts.index')}}" class="nav-link">--}}
{{--                                Посты--}}
{{--                            </a>--}}
{{--                        </li>--}}

                        <li class="nav-item">
                            <a href="{{route('about')}}" class="nav-link">
                                О сайте
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link left-menu-link" href="{{ route('actors.index') }}">
                                Актёры
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link left-menu-link" href="{{ route('movies.index') }}">
                                Фильмы
                            </a>
                        </li>



                        @if (Route::currentRouteName() == 'movie.search' || Route::currentRouteName() == 'movies.index')
                            <form class="form-inline ml-3 my-lg-0" action="{{url('movies_search')}}" method="get">
                                <div class="form-group">
                                    <input type="search" name="query" class="form-control mr-sm-2" placeholder="Поиск...">
                                    <button type="submit" class="btn btn-primary my-2 my-sm-0">Поиск</button>
                                </div>
                            </form>
                        @elseif (Route::currentRouteName() == 'actor.search' || Route::currentRouteName() == 'actors.index')
                            <form class="form-inline ml-3 my-lg-0" action="{{url('actors_search')}}" method="get">
                                <div class="form-group">
                                    <input type="search" name="query" class="form-control mr-sm-2" placeholder="Поиск...">
                                    <button type="submit" class="btn btn-primary my-2 my-sm-0">Поиск</button>
                                </div>
                            </form>
                        @endif

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
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">



                                    @if(isset(config('admin.admin_list')[ Auth::user()->id]))
                                        @if(config('admin.admin_list')[ Auth::user()->id] ==  Auth::user()->email)

                                            <a href="{{ route('categories.index',  Auth::user()) }}" class="dropdown-item">
                                                Категории
                                            </a>

                                            <a class="dropdown-item" href="{{ route('genres.index') }}">
                                                Жанры
                                            </a>
                                        @endif
                                    @endif

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

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>
</body>
</html>
