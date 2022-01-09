@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                    پروژه های فعال
                </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body">
                    <div class="row">
                        @foreach ($projects as $project)
                            <div class="col-sm-4 mb-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$project->title}}</h5>
                                        <p class="card-text">{{Str::limit($project->description,40)}}</p>

                                    </div>

                                    <div class="card-footer text-muted">
                                        {{$project->when}}
                                        <div class="d-grid gap-2">

                                            <a href="{{route('projects.show',$project->id)}}" class="btn btn-sm btn-link">مشاهده</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-sm-4 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">پروژه جدید</h5>
                                    <p class="card-text">...</p>

                                </div>
                                <div class="card-footer">
                                    <div class="d-grid gap-2">

                                        <a href="{{route('projects.create')}}" class="btn btn-outline-success">افزودن</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    آرشیو
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    <div class="row">
                        @foreach ($projects_ended as $project)
                            <div class="col-sm-4 mb-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$project->title}}</h5>
                                        <p class="card-text">{{Str::limit($project->description,40)}}</p>

                                    </div>

                                    <div class="card-footer text-muted">
                                        {{$project->when}}
                                        <div class="d-grid gap-2">

                                            <a href="{{route('projects.show',$project->id)}}" class="btn btn-sm btn-link">مشاهده</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
