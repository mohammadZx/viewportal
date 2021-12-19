<form action="{{route('comment.store')}}" enctype="multipart/form-data" method="post">

    @csrf
    
    <div class="form-group row">
        <div class="col-md-2">
            <input type="radio" class="btn-check" required value="Malpositioning" name="graph" id="Malpositioning" >
            <label class="btn btn-outline-success" for="Malpositioning">Malpositioning</label> 
        </div>
        <div class="col-md-2">
            <input type="radio" class="btn-check" required value="bad exposure" name="graph" id="bad-exposure">
            <label class="btn btn-outline-success" for="bad-exposure">bad exposure</label> 
        </div>
        <div class="col-md-2">
            <input type="radio" class="btn-check" required value="artifacts" name="graph" id="artifacts">
            <label class="btn btn-outline-success" for="artifacts">artifacts</label> 
        </div>
        <div class="col-md-2">
            <input type="radio" class="btn-check" required value="no labelling" name="graph" id="labelling">
            <label class="btn btn-outline-success" for="labelling">no labelling</label> 
        </div>
        <div class="col-md-2">
            <input type="radio" class="btn-check" required value="bad colimating" name="graph" id="bad-colimating">
            <label class="btn btn-outline-success" for="bad-colimating">bad colimating</label> 
        </div>
    </div>


    <div class="form-group row">
        <label for="tech" class="text-md-right">tech <strong class="text-danger">*</strong></label>
        <input id="tech" type="text" class="form-control @error('tech') is-invalid @enderror" name="tech" value="{{ old('tech') }}" required>
           @error('tech')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group row">
    <label for="interpretation" class="text-md-right">interpretation <strong class="text-danger">*</strong></label>
        <textarea name="interpretation" id="interpretation" class="form-control @error('interpretation') is-invalid @enderror" name="interpretation" value="{{ old('interpretation') }}" required></textarea>
        @error('interpretation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group row">
        <label for="diagnosis" class="text-md-right">diagnosis <strong class="text-danger">*</strong></label>
        <input id="diagnosis" type="text" class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis" value="{{ old('diagnosis') }}" required>
           @error('diagnosis')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group row">
        <label for="content" class="text-md-right">توضیحات <strong class="text-danger">*</strong></label>
        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ old('content') }}" required></textarea>
        @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="row">
               <div class="col">
               <p class="image-count-box" data-count="20"><span class="text-danger">نکته: </span>شما تنها مجاز به افزودن <span class="count-image">20</span> تصویر می باشید</p>
               </div>
        </div>
        <input type="hidden" name="request_id" value="{{$request->id}}">
    </div>
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

    <button class="btn btn-primary">ثبت</button>

</form>

<hr>