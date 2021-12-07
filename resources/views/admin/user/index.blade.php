@extends('layouts.app')

@section('content')
<div class="card-header">مدیریت کاربران</div>

<div class="card-body">
    <form action="" class="search row">
        <div class="col-md-3"><input type="text" name="search" placeholder="جستجوی کاربران" class="form-control" @if(request()->has('search')) value="{{request()->get('search')}}" @endif></div> 
        <div class="col-md-3"><button class="btn btn-primary">ثبت</button></div>
    </form>
    <ul class="list-group mt-3">
        @foreach($users as $user)
        <li class="list-group-item @if($user->getMeta('status', true) == 'disable') border border-secondary @endif">
            <div class="row">
                <div class="col-md-6"><a href="{{route('user.show', $user->id)}}" class="h5">{{$user->name}}</a> - <strong class="text-danger">{{__('auth.'. $user->role)}}</strong></div>
                <div class="col-md-6"><span class="h5">تراکنش ها: {{$user->transactions()->count()}}</span> - <strong class="text-danger">{{__('auth.'. $user->role)}}</strong></div>
                @can('see-user')
                <a href="{{route('user.show', $user->id)}}" class="btn btn-sm btn-primary">نمایش</a>
                @endcan
                @can('edit-user')
                <a href="{{route('user.a_password', $user->id)}}" class="btn btn-sm btn-warning">ویرایش رمز</a>
                <a href="{{route('user.a_data', $user->id)}}" class="btn btn-sm btn-warning">ویرایش</a>
                @endcan
                @can('delete-user')
                <form method="post" action="{{route('user.destroy', $user->id)}}" class="confirm">
                    @csrf
                    @method('delete')
                    <button class="btn btn-sm btn-danger">حذف</button>
                </form>
                @endcan
            </div>
            <div class="row mt-3">
                <div class="info">
                    <p>تلفن: {{$user->phone}}</p>
                    <p>ایمیل: {{$user->email}}</p>
                    <p>کیف پول: {{$user->wallet}} @can('edit-user') <button class="btn btn-sm btn-warning toggleclass" data-class=".wallet-clear-form">تسویه</button>@endcan</p>
                </div>
            </div>
            @can('edit-user')
            <div class="wallet-clear-form unactive">
                <form action="{{route('user.clear-wallet', $user->id)}}" class="row" method="post">
                    @csrf
                    <div class="col-md-4"><input type="text" name="authority" required placeholder="کد پیگیری" class="form-control"></div>
                    <div class="col-md-4"><input type="text" name="comment" placeholder="توضیحات" class="form-control"></div>
                    <div class="col-md-4"><button class="btn btn-primary">ارسال</button></div>
                </form>
            </div>
            @endcan
        </li>
        @endforeach
    </ul>
    {{$users->links()}}
</div>

@endsection