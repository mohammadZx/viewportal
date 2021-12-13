@extends('layouts.app')

@section('content')
<div class="card-header">مدیریت دسته ها</div>

<div class="card-body">
    <a href="{{route('option.create')}}" class="btn btn-primary">اضافه کردن کوپن جدید</a>
    <ul class="list-group mt-3">
        @foreach($options as $option)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">نام: {{$option->name}}</div>
                <div class="col-md-3">توضیحات: {{$option->content}}</div>
                <div class="col-md-3">
                    <form action="{{route('option.destroy', $option->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                    <a href="{{route('option.edit', $option->id)}}" class="btn btn-sm btn-primary">ویرایش</a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {{$options->links()}}
</div>

@endsection