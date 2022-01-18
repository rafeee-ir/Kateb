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

    <!-- Scripts -->

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
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
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

                <div class="row justify-content-center">
                    @guest
                    @else
                    <div class="col-lg-2 mb-3">
{{--                        <div class="card">--}}
{{--                            <div class="card-header">{{ __('منو') }}</div>--}}
{{--                            <div class="card-body">--}}
                                <div class="list-group">
{{--                                    <a href="#" id="time" class="list-group-item list-group-item-action disabled">--}}
{{--                                    </a>--}}
                                    <a href="{{ route('home') }}" class="list-group-item list-group-item-action">
                                        داشبورد
                                    </a>
{{--                                    <a href="{{url('/user').'/'.Auth::id()}}" class="list-group-item list-group-item-action">پروفایل من</a>--}}
{{--                                    <a href="{{ route('myActivities') }}" class="list-group-item list-group-item-action">فعالیت های من</a>--}}
{{--                                    <a class="list-group-item list-group-item-action disabled">A disabled link item</a>--}}
                                </div>
                                <div class="list-group mt-3">
                                    <a href="{{ route('projects.index') }}" class="list-group-item list-group-item-action">پروژه ها</a>
                                    <a href="{{ route('projects.create') }}" class="list-group-item list-group-item-action">پروژه جدید</a>


                                </div>
                                <div class="list-group mt-3">

                                    <a href="{{route('portfolios.index')}}" class="list-group-item list-group-item-action">نمونه کارها</a>
                                    <a href="#" class="list-group-item list-group-item-action disabled list-group-item-secondary">همکاران</a>
                                    <a href="#" class="list-group-item list-group-item-action disabled list-group-item-secondary">فاکتورها</a>

                                </div>
                                <div class="list-group mt-3">
                                    <a href="{{ route('users') }}" class="list-group-item list-group-item-action">کاربران</a>
                                    <a href="{{ route('activities') }}" class="list-group-item list-group-item-action">فعالیت ها</a>

                                </div>
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <script type="text/javascript">--}}
{{--                            function showTime() {--}}
{{--                                var date = new Date(),--}}
{{--                                    utc = new Date(Date.now(--}}
{{--                                        date.getFullYear(),--}}
{{--                                        date.getMonth(),--}}
{{--                                        date.getDate(),--}}
{{--                                        date.getHours(),--}}
{{--                                        date.getMinutes(),--}}
{{--                                        date.getSeconds()--}}
{{--                                    ));--}}

{{--                                document.getElementById('time').innerHTML = utc.toLocaleTimeString();--}}
{{--                            }--}}
{{--                            showTime();--}}

{{--                            // setInterval(showTime, 1000);--}}
{{--                        </script>--}}
                        </div>
                    @endguest
                    <div class="col-lg-10">
                    @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>
