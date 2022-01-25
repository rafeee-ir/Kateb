@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
{{--<tickets :user="{{ Auth::user() }}"></tickets>--}}

{{--    <div class="card mt-1">--}}
{{--        <div class="card-body">--}}
            <div class="list-group">
                @foreach($departments as $department)
                <div class="list-group-item list-group-item-action list-group-item-secondary">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$department->id}}.{{$department->title}}</h5>
{{--                        <small class="text-muted">حذف</small>--}}
                        <form action="{{route('departments.destroy',$department->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="d-grid gap-2">

                                <button type="submit" class="btn btn-link text-muted">حذف</button>
                            </div>
                        </form>
                    </div>
                    <p class="mb-1">{{$department->description}}</p>
                    <small class="text-muted">10 عضو در این دپارتمان حضور دارند</small>
                </div>
                @endforeach
            </div>
{{--        </div>--}}
{{--    </div>--}}
    <div class="accordion mt-1" id="addingForm">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    افزودن دپارتمان جدید
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="{{route('departments.store')}}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::id()}}">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان دپارتمان </label>
                            <input name="title" type="text" class="form-control" placeholder="نام دپارتمان" id="title" aria-describedby="titleHelp" required>
                            <div id="titleHelp" class="form-text">مثال: مالی</div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات دپارتمان (اختیاری)</label>
                            <textarea class="form-control" name="description" id="description" rows="1"></textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success" type="submit">افزودن</button>
                            <button class="btn btn-outline-secondary" type="reset" >انصراف</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
