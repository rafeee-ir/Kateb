@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="">
                <div class="badge bg-dark text-light">دپارتمان {{$ticket->department->title ?? ''}}</div>
                <div class="badge bg-{{$ticket->statusColor}}">{{$ticket->statusText}}</div>
                </div>
                <small class="text-muted">{{$ticket->when}} | {{$ticket->created_at}}</small>
            </div>

        </div>
    </div>
    <div class="card mt-1">
        <div class="card-body">
            <div class="">
                <div class="badge bg-dark text-light">پروژه {{$ticket->project->title ?? ''}}</div>
                <h2>{{$ticket->title}}</h2>
                <p>{{$ticket->body}}</p>
            </div>
        </div>
    </div>
    <tickets :user="{{Auth::user()}}" :department_id="{{$ticket->department_id ?? 0}}" :project_id="{{$ticket->project->id ?? 0}}" :ticket_user_id="{{$ticket->user_id}}" :ticket_id="{{$ticket->id}}"></tickets>

    <div class="card mt-1">
        <div class="card-body">
            <div  class="d-flex justify-content-between">
                <div></div>
                <div>
                    <button class="btn btn-sm btn-outline-success">بستن تیکت</button>
                </div>
            </div>
        </div>
    </div>
@endsection
