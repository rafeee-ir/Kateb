@extends('layouts.app')

@section('content')

                <div class="card">
                    <div class="card-header">{{$pageTitle}}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table class="table table-hover table-borderless table-striped">
                                <thead>
                                    <tr>
                                        <th>کد</th>
                                        <th>شرح</th>
                                        <th>توسط</th>
                                        <th>تاریخ</th>
                                        <th>تاریخ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                <tr>
                                    <td>{{$log->code}}</td>
                                    <td>{{$log->log}}</td>
                                    <td>{{$log->user_id}}</td>
                                    <td>{{$log->created_at}}</td>
                                    <td>{{$log->when}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                    </div>
                </div>

@endsection
