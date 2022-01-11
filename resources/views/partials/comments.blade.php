
@foreach($comments as $comment)
<div class="display-comment">
    <strong><span class="name">{{ $comment->user->name }}</span> | <span class="time">{{$comment->created_at}}</span> | <span class="type">عنوان: {{__('auth.'.$comment->user->role)}}</span></strong>
    <a href="{{route('user.request_pdf', $comment->id)}}" target="_blank">چاپ</a>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>Status</th>
            <td>{{ $comment->getMeta('status', true) ? 'تایید شده توسط کارشناس دوم' : 'بدون وضعیت' }}</td>
        </tr>
        <tr>
            <th>Graph</th>
            <td>{{ $comment->getMeta('graph', true) }}</td>
        </tr>
        <tr>
            <th>Tech</th>
            <td>{{ $comment->tech }}</td>
        </tr>
        <tr>
            <th>Interpretation</th>
            <td>{{ $comment->interpretation }}</td>
        </tr>
        <tr>
            <th>Diagnosis</th>
            <td>{{ $comment->diagnosis }}</td>
        </tr>
        <tr>
            <th>Comment</th>
            <td>{!! $comment->content !!}</td>
        </tr>
    </table>

    <div class="row attachment comment images">
     @foreach($comment->getMeta('attachment') as $image)
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
    @if(auth()->user()->id == $comment->user_id || auth()->user()->can('admin') || auth()->user()->can('superadmin'))
    <div><a href="{{route('comment.edit', $comment->id)}}" class="btn btn-sm btn-warning">ویرایش</a></div>
    @endif

    @can('addreference', $comment->request)
    <div><a href="{{route('comment.approve', $comment->id)}}" class="btn btn-sm btn-success">تایید</a></div>
    <div><a href="{{route('comment.disapprove', $comment->id)}}" class="btn btn-sm btn-danger">عدم تایید</a></div>
    @endcan

    <hr>
    @include('partials.comments', ['comments' => $comment->replies])
</div>
@endforeach 