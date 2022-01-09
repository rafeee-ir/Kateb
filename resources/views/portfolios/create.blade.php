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

                            <form action="{{ route('portfolios.store') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{Auth::id()}}" name="user_id">

                                <div class="mb-3">
                                    <label for="description" class="form-label">توضیحات</label>
                                    <textarea name="description" title="description" class="form-control" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="project_id" class="form-label">پروژه</label>
                                    <select class="form-select" id="project_id" name="project_id" required>
                                        <option>پروژه را انتخاب کنید</option>
                                        @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{$project->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="owner" class="form-label">کارفرما</label>
                                    <select class="form-select" id="owner" name="owner_id" required>
                                        <option value="0">کارفرما نمونه کار را انتخاب کنید</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="link" class="form-label">لینک محل انتشار</label>
                                    <input type="url" class="form-control" id="link" name="link">
                                </div>
                                <button type="submit" class="btn btn-primary">افزودن پروژه</button>
                            </form>
                    </div>
                </div>

@endsection
