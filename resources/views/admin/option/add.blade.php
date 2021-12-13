@extends('layouts.app')

@section('content')
<div class="card-header">افزودن دسته</div>

<div class="card-body">
<form action="{{route('option.store')}}" method="post">
        @csrf
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">نام <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="content" class="col-md-2 col-form-label text-md-right">توضیحات</label>

            <div class="col-md-6">
                <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" autocomplete="off" autofocus>

                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="attachment_count" class="col-md-2 col-form-label text-md-right">تعداد تصاویر <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="attachment_count" type="number" class="form-control @error('attachment_count') is-invalid @enderror" name="attachment_count" value="{{ old('attachment_count') }}" autocomplete="off" required autofocus>

                @error('attachment_count')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <button class="btn btn-primary">ثبت دسته</button>  
        </div>
    </form>
</div>

@endsection