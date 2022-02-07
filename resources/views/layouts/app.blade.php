<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}
        @isset($pageTitle)
        | {{$pageTitle}}
        @endisset
    </title>
    <link rel="icon" type="image/png" href="{{url('/img/logo.png')}}">

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
                <img src="{{url('/img/logo.png')}}" height="50px" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="تبديل التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    @guest
                                            @if (Route::has('login'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('login') }}">{{ __('ورود') }}</a>
                                                </li>
                                            @endif

                                            @if (Route::has('register'))
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{ route('register') }}">{{ __('ثبت نام') }}</a>
                                                </li>
                                            @endif
                                        @else
{{--                        @can('project-list')--}}

{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{route('home')}}">داشبورد</a>--}}
{{--                        </li>--}}
{{--                        @endcan--}}
                        @can('project-list')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('projects*') ? 'active' : '' }}" href="{{route('projects.index')}}">پروژه</a>
                        </li>
                        @endcan
{{--                        @can('ticket-list')--}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('tickets*') ? 'active' : '' }}" href="{{route('tickets.index')}}">پشتیبانی</a>
                        </li>
{{--                        @endcan--}}
                        @can('portfolio-list')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('portfolios*') ? 'active' : '' }}" href="{{route('portfolios.index')}}">نمونه کار</a>
                        </li>
                        @endcan
                        @can('admin-list')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="#">مدیریت</a>
                        </li>
                        @endcan

                        <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                    کاربری
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
                                                    <li>
                                                        <a class="dropdown-item" href="{{url('/users').'/'.Auth::id()}}">
                                                            {{ __('پروفایل من') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('myActivities') }}">
                                                            {{ __('فعالیتهای من') }}
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            {{ __('خروج') }}
                                                        </a>
                                                    </li>

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
</header>
    <div id="app">

        <main class="py-4">
            <div class="container">
                @isset($pageTitle)
                <h1 class="mb-3">{{$pageTitle}}</h1>
                <hr>
                @endisset
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="row justify-content-center">

                    <div class="col">

                        <check-online></check-online>


                        @yield('content')
                        <hr>
                        <p class="mt-3 text-sm-start text-secondary">مدیریت و پشتیبانی پروژه کارامانا</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script type="text/javascript">
    @auth
        window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
    @else
        window.Permissions = [];
    @endauth
</script>
    <script src="{{ asset('js/app.js') }}" defer></script>


</body>

</html>
