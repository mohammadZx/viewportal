@extends('layouts.app')

@section('content')
<div class="card-header">مدیریت کاربران</div>

<div class="card-body">
    <ul class="list-group mt-3">
        @foreach($transactions as $tr)
        <li class="list-group-item @if(!$tr->status) border border-danger @endif">
            <div class="row">
                <div class="col-md-2">نام: {{$tr->user->name}}</div>
                <div class="col-md-2">هزینه: {{$tr->price}} تومان</div>
                <div class="col-md-6">شماره شبا: {{$tr->user->getMeta('shaba', true)}} تومان</div>
            </div>
            <div class="row">
                <div class="col {{$tr->status ? 'text-success' : 'text-danger'}}">وضعیت: {{$tr->status ? 'پرداخت شده' : 'پرداخت نشده'}}</div>
                @if(!$tr->status)
                <div class="col">
                    <form action="{{route('wallet_order')}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{$tr->id}}">
                        <input placeholder="کد پیگیری" class="form-control" type="text" name="authority" id="">
                        <input class="btn btn-primary" type="submit" value="پرداخت">
                    </form>
                </div>
                @endif
            </div>
        </li>
        @endforeach
    </ul>
    {{$transactions->links()}}
</div>

@endsection