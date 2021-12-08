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
            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="off" autofocus>

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="content" class=" col-form-label text-md-right">توضیحات بیشتر</label>
            <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content">{{ old('title') }}</textarea>

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
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>

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
                    <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="off" autofocus>

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
                    <input id="material" type="text" class="form-control @error('material') is-invalid @enderror" name="material" value="{{ old('material') }}" required autocomplete="off" autofocus>

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
                    <input id="race" type="text" class="form-control @error('race') is-invalid @enderror" name="race" value="{{ old('race') }}" required autocomplete="off" autofocus>

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
                    <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" required autocomplete="off" autofocus>

                    @error('weight')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="history" class=" col-form-label text-md-right">تاریخچه بیماری <strong class="text-danger">*</strong></label>
                    <input id="history" type="text" class="form-control @error('history') is-invalid @enderror" name="history" value="{{ old('history') }}" required autocomplete="off" autofocus>

                    @error('history')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
      
            <div class="field row">
                <div class="">
                    <input class="d-none reqfile" type="file" id="files0" name="files[]" />
                </div>
                <div class="col-md-3">
                    <label for="files0" class="labelfor">
                        <i class="fa fa-plus display-1"></i>
                    </label>
                </div>
            </div>

        </div>
        <button class="btn btn-primary">ثبت سوال</button>
    </form>
    </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script>
    var requestCounter = 0;
    function requestFileUploader(){
        $(".reqfile").on("change", function(e) {
            for (f of this.files) {
                $(this).parent().addClass('col-md-3');
                var obj = URL.createObjectURL(f);
                $(this).parent().append(`<div class='imgreq'><img class='imageThumb' src='${obj}'> <span class='remove'><i class='fa fa-window-close'></i></span></div>`);
                requestCounter++;
                $( `<div class=""> <input class="d-none reqfile" type="file" id="files${requestCounter}" name="files[]" /> </div>` ).insertAfter($(this).parent());
                $('.labelfor').attr('for','files'+requestCounter);       
                
                $(".remove").click(function(){
                    $(this).parent().parent().remove()
                })
            }
            
            requestFileUploader()
        });
    }
    requestFileUploader()
    
   </script>
@endsection