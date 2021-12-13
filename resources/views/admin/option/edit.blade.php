@extends('layouts.app')

@section('content')
<div class="card-header">افزودن دسته</div>

<div class="card-body" id="edit-option" data-option="{{$option->id}}">
<form action="{{route('option.update', $option->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">نام <strong class="text-danger">*</strong></label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $option->name}}" required autocomplete="off" autofocus>

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
                <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') ? old('content') : $option->content }}" autocomplete="off" autofocus>

                @error('content')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="attachment_count" class="col-md-2 col-form-label text-md-right">تعداد تصاویر <strong class="text-danger">*</strong></label>
    @php
    $attachmentCount = $option->roles()->where('role_key', 'attachment_count')->first();
    @endphp
            <div class="col-md-6">
                <input id="attachment_count" type="number" class="form-control @error('attachment_count') is-invalid @enderror" name="attachment_count" value="{{ old('attachment_count') ? old('attachment_count') : ($attachmentCount ? $attachmentCount->role_value : 1) }}" autocomplete="off" required autofocus>

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
    <hr>
    <div class="row">
        <div class="col-md-12 accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <button class="text-right btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    مدیریت کارشناسان
                    </button>
                </div>
                <div id="collapseOne" class="card-body collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <varc></varc>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingTwo">
                    <button class="text-right btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    مدیریت اشتراک
                    </button>
                </div>
                <div id="collapseTwo" class="card-body collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                   <typec></typec>
                </div>
            </div>
        </div>
     
    </div>
</div>
<script src="{{ asset('js/adminoption.js') }}" type="module" defer></script>
@endsection