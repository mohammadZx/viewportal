@extends('layouts.app')

@section('content')


<div class="card-header">سوالات</div>

<div class="card-body">
    <ul class="list-group mt-3">
        @foreach($comments as $comment)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">پاسخ دهنده: {{$comment->user->name}}</div>
                <div class="col-md-3">عنوان: {{$comment->request->title}}</div>
                <div class="col-md-3"><a href="{{route('user.request', $comment->request->id)}}" class="btn btn-sm btn-primary">مشاهده</a></div>
                <div class="col-md-3"><a href="{{route('comment.edit', $comment->id)}}" class="btn btn-sm btn-warning">ویرایش</a></div>
            </div>
        </li>
        @endforeach
    </ul>
    {{$comments->links()}}
</div>


@endsection