@extends('layouts.app')

@section('content')
    @if($ticket->status==4)
    <div class="alert alert-dark alert-dismissible fade show" role="alert">
        <strong>این تیکت بسته است</strong> برای باز کردن مجدد تیکت کافی است یک پاسخ جدید ارسال کنید
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="">
                <div class="badge bg-dark text-light">دپارتمان {{$ticket->department->title ?? ''}}</div>
                <div class="badge bg-{{$ticket->statusColor}}">{{$ticket->statusText}}</div>
                </div>
                <small class="text-muted">{{$ticket->when}} | {{$ticket->created_at}}</small>
            </div>


            <div class="mt-3">
                @isset($ticket->project->title)
                <div class="badge bg-dark text-light">پروژه {{$ticket->project->title ?? ''}}</div>
                @endisset
                <h2>{{$ticket->title}}</h2>
                <p>{{$ticket->body}}</p>
            </div>
        </div>
    </div>
    <tickets :user="{{Auth::user()}}" :department_id="{{$ticket->department_id ?? 0}}" :project_id="{{$ticket->project->id ?? 0}}" :ticket_user_id="{{$ticket->user_id}}" :ticket_id="{{$ticket->id}}"></tickets>


@endsection

