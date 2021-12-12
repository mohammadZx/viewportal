@extends('layouts.app')

@section('content')
<div class="card-header">ویرایش کوپن</div>

<div class="card-body">
<form action="{{route('coupon.update', $coupon->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group row">
            <label for="code" class="col-md-2 col-form-label text-md-right">کد <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') ? old('code') : $coupon->code }}" required autocomplete="off" autofocus>

                @error('code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-md-2 col-form-label text-md-right">توضیحات</label>

            <div class="col-md-6">
                <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') ? old('content') : $coupon->content }}" autocomplete="off" autofocus>

                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="discount" class="col-md-2 col-form-label text-md-right">هزینه <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="discount" type="number" class="form-control @error('discount') is-invalid @enderror" name="discount" value="{{ old('discount') ? old('discount') : $coupon->discount }}" required autocomplete="off" autofocus>

                @error('discount')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>   
        </div>
        <div class="form-group">
            <label for="type">درصدی</label>
            <input type="radio" required value="percent" @if(old('type') == 'percent') checked  @elseif($coupon->discount_type == 'percent') checked @endif name="type" id="type">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <label for="type2">ثابت</label>
            <input type="radio" required value="static" @if(old('type') == 'static') checked   @elseif($coupon->discount_type == 'static') checked @endif name="type" id="type2">
        </div>

        <div class="form-group row">
            <label for="expire_at" class="col-md-2 col-form-label text-md-right">تاریخ انقضا</label>

            <div class="col-md-6">
                <input id="expire_at" data-jdp class="form-control @error('expire_at') is-invalid @enderror" name="expire_at" value="{{ old('expire_at') ? old('expire_at') : $coupon->expire_at}}" autocomplete="off" autofocus>

                @error('expire_at')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>   
        </div>
        <div class="form-group row">
            <label for="coupon_use" class="col-md-2 col-form-label text-md-right">تعداد استفاده</label>

            <div class="col-md-6">
                <input id="coupon_use" placeholder="0 به معنی بی نهایت" type="number" class="form-control @error('coupon_use') is-invalid @enderror" name="coupon_use" value="{{ old('coupon_use') ? old('coupon_use') : $coupon->coupon_use }}" autocomplete="off" autofocus>

                @error('coupon_use')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>   
        </div>

        <div class="form-group row">
            <label for="role" class="col-md-2 col-form-label text-md-right">استفاده برای</label>

            <div class="col-md-6">
                <select name="role[]" id="role" class="form-control select2" multiple="multiple" value="{{old('role')}}">
                    
                    @foreach($options as $option)
                    <option value="{{$option->id}}">{{$option->name}}</option>
                    @endforeach
                
                </select>
                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>   
        </div>
        <div class="form-group row">
            <button class="btn btn-primary">ثبت کوپن</button>  
        </div>
    </form>
</div>

@endsection