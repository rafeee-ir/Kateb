@extends('layouts.app')

@section('content')

                <div class="card">
                    <div class="card-header">
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{route('projects.create')}}" type="button" class="btn btn-link">+</a>
                        </div>
                        {{ $pageTitle }}
                        <span class="badge bg-primary">{{ count($projects) }}</span>


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
                                        <th>شرح</th>
                                        <th>تاریخ</th>
                                        <th>شروع</th>
                                        <th>پایان</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($projects)>0)
                                @foreach ($projects as $project)
                                    <tr>
                                    <th><a href="{{route('projects.show',$project->id)}}">{{$project->id}}.{{$project->title}}</a></th>
                                    <td>{{$project->description}}</td>
                                    <td>{{$project->when}}</td>
                                    <td>{{$project->start}}</td>
                                    <td>{{$project->end}}</td>
                                </tr>
                                @endforeach
                                @else
                                    <tr class="table-warning">
                                        <td colspan="3">هیچ پروژه ای ندارید</td>
                                    </tr>
                                @endif

                                </tbody>
                            </table>
                    </div>
                </div>

@endsection
