@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <!--        <div class="card-header">وضعیت تیکت ها</div>-->
        <div class="card-body">
            <div class="row row-cols-5 g-4">
                <div class="col">
                    <div class="card h-100 bg-success text-light">
                        <div class="card-body">
                            <h5 class="card-title">{{$tickets_stats[2]}}</h5>
                            <p class="card-text">در حال انجام</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-danger">
                        <div class="card-body">
                            <h5 class="card-title">{{$tickets_stats[1]}}</h5>
                            <p class="card-text">باز</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-primary">
                        <div class="card-body">
                            <h5 class="card-title">{{$tickets_stats[3]}}</h5>
                            <p class="card-text">پاسخ داده شده</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-warning">
                        <div class="card-body">
                            <h5 class="card-title">{{$tickets_stats[4]}}</h5>
                            <p class="card-text">پایان یافته</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100 border-dark">
                        <div class="card-body">
                            <h5 class="card-title">{{$tickets_stats[0]}}</h5>
                            <p class="card-text">مجموع تیکت ها</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-1">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{route('departments.index')}}" class="btn btn-sm btn-outline-dark">دپارتمان ها</a>

                </div>
                <div>
                    <a href="{{route('tickets.create')}}" class="btn btn-sm btn-warning">ارسال تیکت جدید</a>

                </div>
            </div>

        </div>
    </div>
{{--    <div class="card mt-1">--}}
{{--        <div class="card-body">--}}
            <div class="list-group mt-3">
                @forelse($tickets as $ticket)
                <a href="{{route('tickets.show',$ticket->id)}}" class="list-group-item list-group-item-action list-group-item-{{$ticket->statusColor}}">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$ticket->title}}</h5>
                        <div>
{{--                        <small class="text-muted">{{$ticket->when}}</small>--}}
{{--                        <small class="text-muted">|</small>--}}
                        <small class="text-muted">{{$ticket->statusText}}</small>
                        </div>
                    </div>
                    <p class="mb-1">{{Str::limit($ticket->body,40)}}</p>
                    <small class="badge bg-light text-muted">کد پیگیری {{$ticket->id}}</small>
                    <small class="badge bg-light text-muted">دپارتمان {{$ticket->department->title ?? ''}}</small>
                </a>
                @empty
                    <div class="alert alert-info">در اینجا هیچ تیکتی برای شما وجود ندارد</div>
                @endforelse
            </div>
{{--        </div>--}}
{{--    </div>--}}

@endsection
