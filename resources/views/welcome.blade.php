@extends('layouts.app')

@section('content')

    <div class="p-5 mb-4 bg-info rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">کارامانا</h1>
            <p class="col-md-8 fs-4">سیستم مدیریت و پشتیبانی پروژه مشتریان اختصاصی کارامانا</p>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary my-2 btn-lg">ورود</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary my-2 btn-lg">عضویت</a>
                @else
{{--                    @can('dashboard-visit')--}}
{{--                    <a href="{{ route('home') }}" class="btn btn-primary my-2 btn-lg">داشبورد</a>--}}
{{--                    @endcan--}}
{{--                    @can('project-list')--}}
{{--                            <a href="{{ route('projects.index') }}" class="btn btn-dark my-2 btn-lg">پروژه های من</a>--}}
{{--                        @endcan--}}
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary my-2 btn-lg">تیکت پشتیبانی</a>
                @endguest
        </div>
    </div>
    <nav class="navbar navbar-light bg-light mb-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">برخی از نمونه کارهای انجام شده در کارامانا</a>
        </div>
    </nav>
    <div class="row row-cols-1 row-cols-md-3 g-4 mb-4">

@forelse($portfolios as $portfolio)
        <div class="col">
            <div class="card">
                @if($portfolio->pic!==null)
                    <a rel="nofollow" href="{{$portfolio->link}}"target="_blank">
                        <img title="مشاهده نمونه کار" src="{{asset('storage/'.$portfolio->pic)}}" class="card-img-top img-fluid" style="object-fit: cover;height: 250px"  alt="{{Str::limit($portfolio->description,40)}}">
                    </a>
                @endif
                <div class="card-body">
                    <div class="h5">{{$portfolio->project->title}}</div>
                    <div class="card-title">{{Str::limit($portfolio->description,40)}}</div>
                    <a rel="nofollow" href="{{$portfolio->link}}" class="btn btn-secondary btn-sm" target="_blank">مشاهده نمونه کار</a>

                </div>
            </div>
        </div>
    @empty
    @endforelse
    </div>

    <hr>

    <div class="row align-items-md-stretch">

        <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>نمونه کار و پروژه ها</h2>
                <p>برای مشاهده نمونه کارهای انجام شده در زمینه محتوا، دیزاین و.. کلیک کنید</p>
                <a class="btn btn-outline-secondary" href="{{route('portfolios.index')}}" type="button">مشاهده همه نمونه کارها</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 text-light bg-secondary rounded-3">
                <h2>ارتباط با ما</h2>
                <p>می توانید از طریق واتساپ یا تلگرام با شماره 09904055002 در تماس باشید</p>
                <button class="btn btn-success" type="button">واتساپ</button>
                <button class="btn btn-outline-light" type="button">تلگرام</button>
            </div>
        </div>
    </div>



@endsection
