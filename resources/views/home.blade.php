@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @can('project-list')

                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h1 class="card-title">{{$projects_active}}</h1>
                                        <p class="card-text">
                                        پروژه فعال در کارامانا</p>
                                        <a href="{{route('projects.index')}}" class="btn btn-primary">مشاهده پروژه ها</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h1 class="card-title">{{$projects_ended}}</h1>
                                        <p class="card-text">
                                            پروژه در کارامانا با موفقیت به پایان رسیده است.
                                        </p>
                                        <a href="{{route('projects.index')}}" class="btn btn-primary">مشاهده پروژه ها</a>
                                    </div>
                                </div>
                            </div>
                                @can('project-create')
                            <div class="col-sm-2">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h1 class="card-title">+</h1>
                                        <p class="card-text">
                                            ایجاد پروژه جدید در کارامانا
                                        </p>
                                        <a href="{{route('projects.create')}}" class="btn btn-success">افزودن پروژه</a>
                                    </div>
                                </div>
                            </div>
                                @endcan
                        </div>
    @endcan
        <div class="row mb-3">
                <div class="col-sm-2">
                    <div class="card border-warning text-center">
                        <div class="card-body">
                            <h1 class="card-title">?</h1>
                            <p class="card-text">
                                تیکت پشتیبانی
                            </p>
                            <a href="{{route('tickets.create')}}" class="btn btn-success">ثبت تیکت</a>
                        </div>
                    </div>
                </div>
        </div>
@endsection
