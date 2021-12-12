@extends('layouts.app')

@section('content')
   <div class="card-header">
       مدیریت کیف پول
   </div>
   <div class="card-body">
    <div id="wallet">

    <form method="post" action="{{route('user.charge')}}" class="wallet-manage">
        @csrf
        
        <div class="form-group">
            <label for="price">قیمت:  <strong class="text-danger">*</strong></label>

            <div>
                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="off" autofocus>

                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="شارژ کیف پول" class="btn btn-primary">
        </div>
    </form>
    <form method="post" action="{{route('user.liquidation')}}" class="wallet-manage">
        @csrf
        <div class="form-group">
            <input type="submit" value="درخواست تسویه" class="btn btn-primary">
        </div>
    </form>
    <ul class="list-group mt-3">
        @foreach($transactions as $tr)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">نوع: {{__('app.'.$tr->name)}}</div>
                <div class="col-md-3">هزینه: {{$tr->price}} تومان</div>
                <div class="col-md-3">وضیعت: 
                    @if($tr->status)
                    <span class="text-success">موفق</span>
                    @else
                    <span class="text-danger">ناموفق</span>
                    @endif
                </div>
                <div class="col-md-3">تاریخ: {{$tr->created_at}} تومان</div>
               
               
            </div>
        </li>
        @endforeach
    </ul>


    </div>
   </div>
 
@endsection