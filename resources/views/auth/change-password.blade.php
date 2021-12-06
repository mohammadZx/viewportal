@extends('layouts.app')


@section('content')
<div class="card-header">تغییر رمز عبور</div>

<div class="card-body">
    <form method="POST" enctype="multipart/form-data" action="{{ ($userid) ? route('user.a_change_password', $userid) : route('user.change_password') }}">
        @csrf
        @method('PUT')
   
        @if(!$userid)
        <div class="form-group row">
            <label for="old_password" class="col-md-4 col-form-label text-md-right">رمز عبور فعلی <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="old_password" type="text" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ old('old_password') }}" required autocomplete="name" autofocus>

                @error('old_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @endif

        <div class="form-group row">
            <label for="new_password" class="col-md-4 col-form-label text-md-right">رمز عبور جدید <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="new_password" type="text" class="form-control @error('new_password') is-invalid @enderror" name="new_password" value="{{ old('new_password') }}" required autocomplete="name" autofocus>

                @error('new_password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
   
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn border-primary text-primary">
                    تغییر
                </button>
            </div>
        </div>
    </form>
</div>
</div>
@endsection
