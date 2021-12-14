@extends('layouts.app')

@section('content')
   <div class="card-header">
       ثبت سوال
   </div>
   <div class="card-body">
    <div id="send-request">
    <form method="post" enctype="multipart/form-data" action="{{route('user.question_request', $tr->id)}}">
        @csrf
        <div class="form-group">
            <label for="title" class=" col-form-label text-md-right">عنوان <strong class="text-danger">*</strong></label>
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ? old('title') : $request->title }}" required autocomplete="off" autofocus>

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="content" class=" col-form-label text-md-right">توضیحات بیشتر</label>
            <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content">{{ old('content') ? old('content') : $request->content }}</textarea>

            @error('content')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name" class=" col-form-label text-md-right">نام حیوان <strong class="text-danger">*</strong></label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $request->name }}" required autocomplete="off" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="age" class=" col-form-label text-md-right">سن حیوان <strong class="text-danger">*</strong></label>
                    <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') ? old('age') : $request->age }}" required autocomplete="off" autofocus>

                    @error('age')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="material" class=" col-form-label text-md-right">جنس حیوان <strong class="text-danger">*</strong></label>
                    <input id="material" type="text" class="form-control @error('material') is-invalid @enderror" name="material" value="{{ old('material') ? old('material') : $request->material }}" required autocomplete="off" autofocus>

                    @error('material')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="race" class=" col-form-label text-md-right">نژاد <strong class="text-danger">*</strong></label>
                    <input id="race" type="text" class="form-control @error('race') is-invalid @enderror" name="race" value="{{ old('race') ? old('race') : $request->material }}" required autocomplete="off" autofocus>

                    @error('race')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="weight" class=" col-form-label text-md-right">وزن <strong class="text-danger">*</strong></label>
                    <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') ? old('weight') : $request->weight }}" required autocomplete="off" autofocus>

                    @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="history" class=" col-form-label text-md-right">تاریخچه بیماری </label>
                    <input id="history" type="text" class="form-control @error('history') is-invalid @enderror" name="history" value="{{ old('history') ? old('history') : $request->weight }}" autocomplete="off" autofocus>

                    @error('history')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
               <div class="col">
               <p class="image-count-box" data-count="{{$imageCount ? $imageCount->role_value : IMAGECOUNT}}"><span class="text-danger">نکته: </span>شما تنها مجاز به افزودن <span class="count-image">{{$imageCount ? $imageCount->role_value : IMAGECOUNT}}</span> تصویر می باشید</p>
               </div>
        </div>
        <div class="field row images">
            @foreach($request->attachment as $image)
            @php $attachmentById = getAttachmentById($image->meta_value); @endphp
            @if(istype($attachmentById, 'image'))
                    <div class="col-md-3">
                    <button class="btn btn-viewer" data-src="{{$attachmentById}}" type="button" data-toggle="modal" data-target=".popupviewer"><i class="fa fa-eye"></i></button>
                    <img src="{{$attachmentById}}" alt="">
                    </div>
                @endif
                @if(istype($attachmentById, 'audio'))
                    <div class="col-md-6">
                    <audio src="{{$attachmentById}}" controls preload="none"></audio>
                    </div>
                @endif
            @endforeach
        </div>
        <hr>
        <div class="field row images">
            <div class="">
                <input accept="image/*,audio/*" class="d-none reqfile" type="file" id="files0" name="files[]" />
            </div>
            <div class="col-md-3">
                <label for="files0" class="labelfor">
                    <i class="fa fa-plus display-1"></i>
                </label>
            </div>
        </div>
        <hr>
        @if($request->id)
        <input type="hidden" name="req_id" value="{{$request->id}}">
        @endif
        <button class="btn btn-primary">ثبت سوال</button>
    </form>
    </div>
   </div>

@endsection