@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
                <div class="card">
                    <div class="card-header">
                        {{ $pageTitle }}
                    </div>

                    <div class="card-body">

                            <form enctype="multipart/form-data" action="{{ route('portfolios.store') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{Auth::id()}}" name="user_id">

                                <div class="mb-3">
                                    <label for="description" class="form-label">توضیحات</label>
                                    <textarea name="description" title="description" class="form-control" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="project_id" class="form-label">پروژه</label>
                                    @if(request()->get('project_id'))
                                        @foreach($projects as $project)
                                            @if($project->id==request()->get('project_id'))
                                                <input type="text" id="project_id" value="{{$project->title}}" class="form-control" readonly>
                                                <input type="hidden" value="{{$project->id}}" name="project_id">
                                            @endif
                                        @endforeach
                                    @else
                                    <select class="form-select" id="project_id" name="project_id" required>
                                        <option>پروژه را انتخاب کنید</option>
                                        @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{$project->title}}</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label for="owner" class="form-label">کارفرما</label>
                                    @if(request()->get('owner_id'))
                                        @foreach($users as $user)
                                            @if($user->id==request()->get('owner_id'))
                                                <input type="text" id="project_id" value="{{$user->name}}" class="form-control" readonly>
                                                <input type="hidden" value="{{$user->id}}" name="project_id">
                                            @endif
                                        @endforeach
                                    @else
                                    <select class="form-select" id="owner" name="owner_id" required>
                                        <option value="0">کارفرما نمونه کار را انتخاب کنید</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @endif

                                </div>
                                <div class="mb-3">
                                    <label for="link" class="form-label">لینک محل انتشار</label>
                                    <input type="url" class="form-control" id="link" name="link">
                                </div>
                                <div class="form-group">
                                    <input type="file" name="pic" placeholder="Choose image" id="pic">
                                    @error('pic')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">افزودن پروژه</button>
                            </form>
                    </div>
                </div>

@endsection
