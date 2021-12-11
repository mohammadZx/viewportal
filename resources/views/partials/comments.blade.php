
@foreach($comments as $comment)
<div class="display-comment">
    <strong><span class="name">{{ $comment->user->name }}</span> | <span class="time">{{$comment->created_at}}</span> | <span class="type">عنوان: {{__('auth.'.$comment->user->role)}}</span></strong>
    <div class="content">
        {!! $comment->content !!}
    </div>
    <div class="row attachment comment images">
     @foreach($comment->getMeta('attachment') as $image)
     <div class="col-md-3">
        <button class="btn btn-viewer" data-src="{{getAttachmentById($image->meta_value)}}" type="button" data-toggle="modal" data-target=".popupviewer"><i class="fa fa-eye"></i></button>
         <img src="{{getAttachmentById($image->meta_value)}}" alt="">
        </div>
     @endforeach
    </div>
    <hr>
    @include('partials.comments', ['comments' => $comment->replies])
</div>
@endforeach 