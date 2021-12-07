@extends('layouts.app')

@section('content')
   <div class="card-header">
       ثبت درخواست
   </div>
   <div class="card-body">
    <div class="row" id="question-from">
        <sendquestionform></sendquestionform>
    </div>
   </div>
   <script src="{{ asset('js/sendquestion.js') }}" type="module" defer></script>
@endsection