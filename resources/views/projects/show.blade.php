@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success mb-3 alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif

    @if ($project->ended===1)
        <div class="alert alert-warning" role="alert">
            این پروژه پایان یافته است
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">


                    <h1>{{$project->title}}</h1>
                    <span>{{$project->when}}</span>
                    <hr>
                    <p>{{$project->description}}</p>

                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{route('comments.store')}}" method="post"  autocomplete="off">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        <input type="hidden" name="project_id" value="{{$project->id}}">
                        <div class="input-group input-group-sm mb-3">
                            <input  autocomplete="off" type="text" class="form-control" placeholder="بنویسید..." name="comment">
                        </div>
                    </form>

                    @forelse($comments as $comment)
                        <div class="mb-2">
                            <div class="d-inline-block px-3 py-1" style="border-radius: 15px 0 15px 15px;background-color: #eeeeee">
                                <span class="text-sm">{{$comment->comment}}</span>
                            </div>
                            <span class="badge bg-light text-secondary rounded-pill">{{$comment->when}}</span>

                        </div>
                        @empty
                            <p class="text-sm">اولین نظر را بنویسید</p>
                            @endforelse
                </div>
            </div>
            <div class="accordion" id="setting">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            تنظیمات
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#setting">
                        <div class="accordion-body row">
                            <div class="col-md-4"><form action="{{route('projects.update',$project->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-grid gap-2">

                                        @if($project->ended===1)

                                            <button type="submit" class="btn btn-secondary" name="ended" value="0">شروع مجدد پروژه</button>
                                        @else
                                            <button type="submit" class="btn btn-info" name="ended" value="1">پایان پروژه</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">

                                    <div class="d-grid gap-2">
                                            <a href="{{route('projects.update',$project->id)}}/edit" class="btn btn-outline-secondary">ویرایش</a>
                                    </div>
                            </div>

                            <div class="col-md-4">
                                <form action="{{route('projects.destroy',$project->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="d-grid gap-2">

                                        <button type="submit" class="btn btn-outline-danger btn-block">حذف پروژه</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    وضعیت پروژه
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        @foreach($logs as $log)
                            <tr class="table-sm">

                                <td title="{{$log->code}}">{{$log->log}} <span class="badge bg-light text-secondary">{{$log->when}}</span></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
