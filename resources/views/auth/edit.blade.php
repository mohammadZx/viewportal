@extends('layouts.app')

@section('content')
<div class="card-header">تغییر اطلاعات کاربری</div>

<div class="card-body">
    <form method="POST" enctype="multipart/form-data" action="{{ ($userid) ? route('user.a_change_data', $userid) : route('user.change_data') }}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <label for="type" class="col-md-4 col-form-label text-md-right">عنوان</label>

            <div class="col-md-6">
                <select value="{{ old('type') ? old('type') : ($user->can('expert') ? 'expert' : 'customer')  }}" name="type"  id="typeuserselect" class="form-control">
                    <option value="customer" @if((old('type') ? old('type') : ($user->can('expert') ? 'expert' : 'customer')) == 'customer') selected @endif>کاربر</option>
                    <option value="expert" @if((old('type') ? old('type') : ($user->can('expert') ? 'expert' : 'customer')) == 'expert') selected @endif>کارشناس</option>
                </select>

                @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if($userid)
        <div class="form-group row">
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="admin_access">دسترسی ادمین</label>
                        <input type="checkbox" @if($user->role == 'admin') checked @endif name="admin_access" id="admin_access">
                    </div>
            </div>
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="active">فعال</label>
                        <input type="radio" @if($user->getMeta('status', true) == 'active') checked @endif name="user_status" value="active" id="active">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label for="disable">غیر فعال</label>
                        <input type="radio" @if($user->getMeta('status', true) == 'disable') checked @endif name="user_status" value="disable" id="disable">
                    </div>
            </div>
        </div>
        @endif
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth.name') }} <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $user->name }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.email') }} <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ? old('email') : $user->email }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="phone" class="col-md-4 col-form-label text-md-right">تلفن <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ? old('phone') : $user->phone }}" required autocomplete="off">

                @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div id="expert" class="edit" style="display: none;@if((old('type') ? old('type') : ($user->can('expert') ? 'expert' : 'customer')) == 'expert') display: block; @endif">
            <div class="form-group row">
                <label for="shaba" class="col-md-4 col-form-label text-md-right">شماره شبا <strong class="text-danger">*</strong></label>

                <div class="col-md-6">
                    <input id="shaba" minlength="22" maxlength="26" type="shaba" value="{{ old('shaba') ? old('shaba') : $user->getMeta('shaba', true) }}" class="form-control @error('shaba') is-invalid @enderror" name="shaba" autocomplete="off">

                    @error('shaba')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            <p class="text-danger">حجم تصاویر باید زیر 300 کیلوبایت باشد</p>
            <div class="row flex-wrap">
                <div class="col-md-4 d-flex flex-column">
                    <p>تصویر کارت ملی</p>
                    <label for="cartmeli" class="btn btn-primary">بارگذاری</label>
                    <input type="file" name="cartmeli" accept="image/*" id="cartmeli" class="d-none file">
                    @error('cartmeli')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <img @if($user->hasMeta('cartmeli')) src="{{getAttachmentById($user->getMeta('cartmeli', true))}}" data-img="{{$user->getMeta('cartmeli', true)}}" @endif>
                </div>
                <div class="col-md-4 d-flex flex-column">
                    <p>کارت نظام دامپزشکی</p>   
                    <label for="nezampezeshki" class="btn btn-primary">بارگذاری</label>
                    <input type="file" name="nezampezeshki" accept="image/*" id="nezampezeshki" class="d-none file">
                    @error('nezampezeshki')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <img @if($user->hasMeta('nezame_dampezeshki')) src="{{getAttachmentById($user->getMeta('nezame_dampezeshki', true))}}" data-img="{{$user->getMeta('nezame_dampezeshki', true)}}" @endif>
                </div>
                <div class="col-md-4 d-flex flex-column">
                    <p>کارت نظام تخصصی</p>
                    <label for="nezampezeshkit" class="btn btn-primary">بارگذاری</label>
                    <input type="file" name="nezampezeshkit" accept="image/*" id="nezampezeshkit" class="d-none file">
                    @error('nezampezeshkit')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <img @if($user->hasMeta('nezame_dampezeshki_t')) src="{{getAttachmentById($user->getMeta('nezame_dampezeshki_t', true))}}" data-img="{{$user->getMeta('nezame_dampezeshki_t', true)}}" @endif>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn border-primary text-primary">
                    {{ __('auth.register') }}
                </button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection