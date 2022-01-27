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
                    <a href="{{ route('home') }}" class="btn btn-primary my-2 btn-lg">داشبورد</a>
                    <a href="{{ route('tickets.index') }}" class="btn btn-secondary my-2 btn-lg">تیکت پشتیبانی</a>
                @endguest
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2>ارتباط با ما</h2>
                <p>می توانید از طریق واتساپ یا تلگرام با شماره 09904055002 در تماس باشید</p>
                <button class="btn btn-success" type="button">واتساپ</button>
                <button class="btn btn-outline-light" type="button">تلگرام</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>نمونه کار</h2>
                <p>برای مشاهده نمونه کارهای انجام شده در زمینه محتوا، دیزاین و.. کلیک کنید</p>
                <button class="btn btn-outline-secondary" type="button">مشاهده نمونه کار</button>
            </div>
        </div>
    </div>



@endsection
