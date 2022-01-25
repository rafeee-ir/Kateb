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
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a href="{{ url('/') }}"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom">

                <img src="{{url('/img/logo.png')}}" height="50px" alt="">
                </a>
{{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
{{--                    {{ config('app.name', 'Laravel') }}--}}
{{--                </a>--}}
                <span></span>

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
                    <ul class="navbar-nav">
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
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{url('/user').'/'.Auth::id()}}">
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
                    @guest
                    @else
                    <div class="col-lg-2 mb-3">
                                <div class="list-group">
                                    <a href="{{ route('home') }}" class="{{ request()->is('dashboard') ? 'active' : '' }} list-group-item list-group-item-action" >
                                        داشبورد
                                    </a>
                                </div>
                                <div class="list-group mt-3">
                                    <a href="{{ route('projects.index') }}" class="{{ request()->is('projects*') ? 'active' : '' }} list-group-item list-group-item-action">پروژه ها</a>
                                    <a href="{{ route('projects.create') }}" class="{{ request()->is('projects/create') ? 'active' : '' }} list-group-item list-group-item-action">پروژه جدید</a>
                                    <a href="{{ route('tickets.index') }}" class="{{ request()->is('tickets*') ? 'active' : '' }} list-group-item list-group-item-action">پشتیبانی</a>


                                </div>
                                <div class="list-group mt-3">

                                    <a href="{{route('portfolios.index')}}"  class="{{ request()->is('portfolios*') ? 'active' : '' }} list-group-item list-group-item-action">نمونه کارها</a>
                                    <a href="#" class="list-group-item list-group-item-action disabled list-group-item-secondary">همکاران</a>
                                    <a href="#" class="list-group-item list-group-item-action disabled list-group-item-secondary">فاکتورها</a>

                                </div>
                                <div class="list-group mt-3">
                                    <a href="{{ route('users') }}" class="{{ request()->is('users*') ? 'active' : '' }} list-group-item list-group-item-action">کاربران</a>
                                    <a href="{{ route('activities') }}" class="{{ request()->is('activities*') ? 'active' : '' }} list-group-item list-group-item-action">فعالیت ها</a>

                                </div>

                        </div>
                    @endguest
                    <div class="col-lg-10">
                        <check-online></check-online>
                    @yield('content')
                        <hr>
                        <p class="mt-3 text-sm-start text-secondary">مدیریت و پشتیبانی پروژه کارامانا</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>
