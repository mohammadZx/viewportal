@extends('layouts.app')

@section('content')


<div class="card-header">درخواست: {{$request->title}}</div>

<div class="card-body">
<div class="section">
       <div class="label">وضعیت: {{__('app.'.$request->status)}}</div>
   </div>
   <div class="section">
        <div class="content">
        توضیحات: {!! $request->content !!}
        </div>
   </div>
   <hr>
 <div class="row">
     <div class="col-md-3">
         نام حیوان: {{$request->getMeta('name', true)}}
     </div>
     <div class="col-md-3">
        سن حیوان: {{$request->getMeta('age', true)}}
     </div>
     <div class="col-md-3">
        جنس : {{$request->getMeta('material', true)}}
     </div>
     <div class="col-md-3">
     نژاد : {{$request->getMeta('race', true)}}
     </div>
     <div class="col-md-3">
     وزن : {{$request->getMeta('weight', true)}}
     </div>
     <div class="col-md-3">
     سابقه : {{$request->getMeta('history', true)}}
     </div>
 </div>
 <hr>
 <div class="row attachment images">
     @foreach($request->getMeta('attachment') as $image)
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
 <div class="meta-items d-flex flex-wrap">
        <div class="meta">دسته: {{$request->transaction->optionVar->option->name}}</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="meta">نوع: {{$request->transaction->optionVar->name}}</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="meta">پلن: {{$request->transaction->optionType->name}}</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="meta">قیمت: {{$request->transaction->price}}</div>&nbsp;&nbsp;&nbsp;&nbsp;
 </div>
 <hr>
 <div class="comments">
     <div class="title">
         پاسخ ها:
     </div>
        @can('addcomment', $request)
            @include('partials.commentform', ['request' => $request])
        @endcan

     @include('partials.comments', ['comments' => $request->comments])
 </div>
</div>


@endsection