@extends('layouts.app')

@section('content')

                <div class="card">
                    <div class="card-header">
                        {{ $pageTitle }}
                    </div>

                    <div class="card-body">

                            <form action="{{ route('tickets.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                <input type="hidden" name="status" value="1">
                                    <div class="h3 mb-3">
                                        ثبت تیکت جدید
                                    </div>
                                    <div class="mb-3">
                                        <label for="department" class="form-label">مربوط به دپارتمان</label>
                                        <select class="form-select" name="department_id" id="department" aria-label="department" aria-describedby="departmentHelp">
                                            <option>دپارتمان مربوطه را انتخاب نمایید</option>
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="title" class="form-label">عنوان تیکت</label>
                                        <input name="title" required type="text" class="form-control" id="title" aria-describedby="titleHelp">
                                        <div id="titleHelp" class="form-text">مثال: مشکل در بارگزاری تصاویر</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="body" class="form-label">محتوای تیکت</label>
                                        <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="file" class="form-label">فایل (اختیاری)</label>
                                        <input class="form-control" name="file" disabled type="file" id="file">
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-success" type="submit">ثبت تیکت پشتیبانی</button>
                                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">انصراف</a>
                                    </div>

                            </form>
                    </div>
                </div>

@endsection
