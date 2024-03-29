@extends('layouts.app')

@section('content')

                <div class="card">
                    <div class="card-header">
                        {{ $pageTitle }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form action="{{ route('projects.store') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{Auth::id()}}" name="user_id">
                                <div class="mb-3">
                                    <label for="name" class="form-label">عنوان پروژه</label>
                                    <input type="text" class="form-control" id="name" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">توضیحات پروژه</label>
                                    <textarea name="description" title="description" class="form-control" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label for="start_date" class="form-label">تاریخ شروع</label>
                                        <input value="<?php echo date('Y-m-d'); ?>" type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="end_date" class="form-label">تاریخ پایان</label>
                                        <input value="<?php echo date("Y-m-d", strtotime("+7 day")); ?>" type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="owner" class="form-label">مالک پروژه</label>
                                    <select class="form-select" id="owner" name="owner_id" required>
                                        <option value="0">مالک پروژه را انتخاب کنید</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">افزودن پروژه</button>
                            </form>
                    </div>
                </div>

@endsection
