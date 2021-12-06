@extends('layouts.app')

@section('content')
<div class="card-header">مدیریت کاربران</div>

<div class="card-body">
    <ul class="list-group">
        @foreach($users as $user)
        <li class="list-group-item @if($user->getMeta('status', true) == 'disable') border border-secondary @endif">
            <div class="row">
                <div class="col-md-6"><a href="{{route('user.show', $user->id)}}" class="h5">{{$user->name}}</a> - <strong class="text-danger">{{__('auth.'. $user->role)}}</strong></div>
                <div class="col-md-6"><span class="h5">خرید ها: {{$user->transactions()->count()}}</span> - <strong class="text-danger">{{__('auth.'. $user->role)}}</strong></div>
                @can('see-user')
                <a href="{{route('user.show', $user->id)}}" class="btn btn-sm btn-primary">نمایش</a>
                @endcan
                @can('edit-user')
                <a href="{{route('user.a_password', $user->id)}}" class="btn btn-sm btn-warning">ویرایش رمز</a>
                <a href="{{route('user.a_data', $user->id)}}" class="btn btn-sm btn-warning">ویرایش</a>
                @endcan
                @can('delete-user')
                <a href="{{route('user.a_data', $user->id)}}" class="btn btn-sm btn-danger">حذف</a>
                @endcan
            </div>
            <div class="row mt-3">
                <div class="info">
                    <p>تلفن: {{$user->phone}}</p>
                    <p>ایمیل: {{$user->email}}</p>
                    <p>کیف پول: {{$user->wallet}} <a href="#" class="btn btn-sm btn-warning">تسویه</a></p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {{$users->links()}}
</div>

@endsection