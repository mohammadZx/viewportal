@extends('layouts.app')

@section('content')
<div class="card-header">مدیریت کوپن ها</div>

<div class="card-body">
    <a href="{{route('coupon.create')}}" class="btn btn-primary">اضافه کردن کوپن جدید</a>
    <ul class="list-group mt-3">
        @foreach($coupons as $coupon)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">نام: {{$coupon->code}}</div>
                <div class="col-md-3">هزینه: {{$coupon->discount}} تومان</div>
                <div class="col-md-3">نوع: {{__('app.'.$coupon->discount_type)}}</div>
                <div class="col-md-3">تاریخ انقضا: {{$coupon->expire_at}}</div>
                <div class="col-md-3">باقیمانده: {{$coupon->coupon_use ? $coupon->coupon_use : 'بی نهایت'}}</div>
                <div class="col-md-3">تعداد: {{$coupon->use()->count()}}</div>
                <div class="col-md-3">مجاز: {{$coupon->valid()}}</div>
                <div class="col-md-3">
                    <form action="{{route('coupon.destroy', $coupon->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger">حذف</button>
                    </form>
                    <a href="{{route('coupon.edit', $coupon->id)}}" class="btn btn-sm btn-primary">ویرایش</a>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {{$coupons->links()}}
</div>

@endsection