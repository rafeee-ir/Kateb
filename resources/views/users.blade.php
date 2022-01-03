@extends('layouts.app')

@section('content')

                <div class="card">
                    <div class="card-header">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-link">+</button>
                        </div>
                        {{ __('کاربران') }}
                        <span class="badge bg-primary">{{count($users)}}</span>


                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <table class="table table-hover table-borderless table-striped">
                                <thead>
                                    <tr>
                                        <th>نام</th>
                                        <th>ایمیل</th>
                                        <th>تاریخ عضویت</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                    <th><a href="{{url('user/'.$user->id)}}">{{$user->name}}</a></th>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                    </div>
                </div>

@endsection
