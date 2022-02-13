@extends('layouts.app')

@section('content')
    <div class="row align-items-center justify-content-center" style="min-height: 80vh">
        <div class="col-md-5 text-center">
            <img src="{{url('storage/done.png')}}" class="mb-4">

                <p class="h2">{{$success}}</p>
            @isset($code)
                <p class="h5 text-muted">کد پیگیری: {{$code}}</p>
            @endisset
            @isset($text)
                <p>{{$text}}</p>
            @endisset
        </div>
    </div>
@endsection
