<form action="{{route('comment.store')}}" method="post">
    <h3>ثبت پاسخ</h3>
    @csrf
    <div class="form-group">
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
        <input type="hidden" name="request_id" value="$request->id">
    <div class="form-group">
    <button class="btn btn-primary">ثبت</button>
    </div>
    </div>
</form>