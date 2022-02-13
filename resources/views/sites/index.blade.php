@extends('layouts.app')

@section('content')

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($sites as $site)
        <div class="col">
            <div class="card h-100 text-center">
{{--                <img src="@if($portfolio->pic!==null) @else img/ph.jpg @endif" class="card-img-top" alt="">--}}
                <div class="card-body">
                    <p class="card-text">{{$site->title}} {{$site->totalPosts}}</p>
                    <a href="{{$site->url}}" class="btn btn-primary btn-sm" target="_blank">مشاهده سایت</a>
                    <a href="https://www.google.com/search?q=site%3A{{$site->url}}&oq=site" class="btn btn-secondary btn-sm" target="_blank">مشاهده ایندکس</a>
                </div>
            </div>
        </div>
        @empty
            <div class="col">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <p class="card-text">هیچ سایتی نیست</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
