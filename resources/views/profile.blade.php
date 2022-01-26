@extends('layouts.app')

@section('content')

                <div class="card">
                    <div class="card-header">{{ __('پروفایل') }} {{ $user->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <table class="table table-hover table-borderless table-striped">
                                <tbody>
                                <tr>
                                    <th scope="row">{{ __('کد کاربری') }}</th>
                                    <td>{{$user->id}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('نام') }}</th>
                                    <td>{{$user->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('تلفن همراه') }}</th>
                                    <td>{{ $user->mobile }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('پست الکترونیکی') }}</th>
                                    <td>{{$user->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('تاریخ تولد') }}</th>
                                    <td>{{$user->dob}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('تاریخ عضویت') }}</th>
                                    <td>{{$user->created_at}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('نقش') }}</th>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                    </div>
                </div>

@endsection
