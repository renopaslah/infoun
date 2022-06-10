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
    @livewireStyles
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @if (session()->get('menus'))
                            @foreach (session()->get('menus') as $v)
                                @if (isset($v['child']))
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $v['name'] }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach ($v['child'] as $v1)
                                                <li><a class="dropdown-item"
                                                        href="{{ url($v1->href) }}">{{ $v1->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page"
                                            href="{{ url($v['href']) }}">{{ $v['name'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ session()->get('profile')->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li>
                                        <h6 class="dropdown-header">Tahun Ajaran</h6>
                                    </li>
                                    @foreach (session()->get('years') as $v)
                                        <li>
                                        @if ($v['id'] == session()->get('current_year')['id'])
                                            <li><a class="dropdown-item active"
                                                    href="{{ URL::to('/year-change/' . Hashids::encode($v['id'])) }}">{{ $v['name'] }}</a>
                                            </li>
                                        @else
                                            <li><a class="dropdown-item"
                                                    href="{{ URL::to('/year-change/' . Hashids::encode($v['id'])) }}">{{ $v['name'] }}</a>
                                            </li>
                                        @endif
                                        </li>
                                    @endforeach
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <h6 class="dropdown-header">Role</h6>
                            </li>
                            @foreach (session()->get('roles') as $v)
                                @if ($v['active'])
                                    <li><a class="dropdown-item active"
                                            href="{{ URL::to('/role-change/' . $v['id']) }}">{{ $v['name'] }}</a>
                                    </li>
                                @else
                                    <li><a class="dropdown-item"
                                            href="{{ URL::to('/role-change/' . $v['id']) }}">{{ $v['name'] }}</a>
                                    </li>
                                @endif
                            @endforeach
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
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
    @livewireScripts
</body>

</html>
