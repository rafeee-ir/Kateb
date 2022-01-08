@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success mb-3 alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif
                <div class="card">
{{--                    <div class="card-header">--}}

{{--                        {{$project->id}}--}}


{{--                    </div>--}}

                    <div class="card-body">

                        @if ($project->ended===1)
                            <div class="alert alert-warning" role="alert">
                                این پروژه پایان یافته است
                            </div>
                        @endif

                        <h1>{{$project->title}}</h1>
                            <span>{{$project->when}}</span>
                            <hr>
                            <p>{{$project->description}}</p>

                    </div>
                </div>
    <div class="card mt-3">
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


{{--    <div class="card mt-3">--}}
{{--                            <div class="card-header">--}}
{{--                                تنظیمات پروژه--}}
{{--                            </div>--}}
{{--        <div class="card-body">--}}
{{--            --}}

{{--        </div>--}}
{{--    </div>--}}
                <div class="accordion mt-3" id="setting">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                تنظیمات
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#setting">
                            <div class="accordion-body">
                                <form action="{{route('projects.update',$project->id)}}" method="post">
                                @csrf
                                @method('PUT')
                                    @if($project->ended===1)

                                <button type="submit" class="btn btn-secondary" name="ended" value="0">شروع مجدد پروژه</button>
                                    @else
                                <button type="submit" class="btn btn-warning" name="ended" value="1">پایان پروژه</button>
                                    @endif
                                </form>
                                <form action="{{route('projects.destroy',$project->id)}}" method="post">
                                @csrf
                                    @method('DELETE')

                                <button type="submit" class="btn btn-danger">حذف پروژه</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
