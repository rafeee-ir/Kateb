@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


                        <div class="row">
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
                            <div class="col-sm-4">
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
                        </div>
<example-component></example-component>
@endsection
