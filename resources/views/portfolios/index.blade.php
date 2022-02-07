@extends('layouts.app')

@section('content')
{{--    <div class="mb-3 text-start">--}}
{{--        <a href="{{route('portfolios.create')}}" class="btn btn-sm btn-outline-primary">نمونه کار جدید</a>--}}
{{--    </div>--}}
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($portfolios as $portfolio)
        <div class="col">
            <div class="card h-100 text-center">
                <img src="@if($portfolio->pic!==null) @else img/ph.jpg @endif" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-text">{{$portfolio->description}}</p>
                </div>
            </div>
        </div>
        @empty
            <div class="col">
                <div class="card h-100 text-center">
                    <div class="card-body">
                        <p class="card-text">هیچ نمونه کاری نیست</p>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
