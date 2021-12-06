@extends('layouts.app')

@section('content')

                <div class="card-header">{{ __('auth.register') }}</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">ثبت نام به عنوان</label>

                            <div class="col-md-6">
                                <select value="{{ old('type') }}" name="type"  id="typeuserselect" class="form-control">
                                    <option value="customer" @if(old('type') == 'customer') selected @endif>کاربر</option>
                                    <option value="expert" @if(old('type') == 'expert') selected @endif>کارشناس</option>
                                </select>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('auth.name') }} <strong class="text-danger">*</strong></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="off">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('auth.password') }} <strong class="text-danger">*</strong></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div id="expert" style="display: none;@if(old('type') == 'expert') display: block; @endif">
                            <div class="form-group row">
                                <label for="shaba" class="col-md-4 col-form-label text-md-right">شماره شبا <strong class="text-danger">*</strong></label>

                                <div class="col-md-6">
                                    <input id="shaba" minlength="22" maxlength="26" type="shaba" value="{{ old('shaba') }}" class="form-control @error('shaba') is-invalid @enderror" name="shaba" autocomplete="off">

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
                                    <p>تصویر کارت ملی <strong class="text-danger">*</strong></p>
                                    <label for="cartmeli" class="btn btn-primary">بارگذاری</label>
                                    <input type="file" name="cartmeli" accept="image/*" id="cartmeli" class="d-none file">
                                    @error('cartmeli')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img>
                                </div>
                                <div class="col-md-4 d-flex flex-column">
                                    <p>کارت نظام دامپزشکی <strong class="text-danger">*</strong></p>   
                                    <label for="nezampezeshki" class="btn btn-primary">بارگذاری</label>
                                    <input type="file" name="nezampezeshki" accept="image/*" id="nezampezeshki" class="d-none file">
                                    @error('nezampezeshki')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img>
                                </div>
                                <div class="col-md-4 d-flex flex-column">
                                    <p>کارت نظام تخصصی <strong class="text-danger">*</strong></p>
                                    <label for="nezampezeshkit" class="btn btn-primary">بارگذاری</label>
                                    <input type="file" name="nezampezeshkit" accept="image/*" id="nezampezeshkit" class="d-none file">
                                    @error('nezampezeshkit')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <img>
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
