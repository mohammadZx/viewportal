@extends('layouts.app')

@section('content')

        
    <div class="card-header">{{ __('app.dashboard') }}</div>

    <div class="card-body">

        @if(auth()->user()->getMeta('status', true) == 'disable')
            <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle" aria-hidden="true"></i> 
                کارشناس گرامی. حساب شما در حال حاضر غیر فعال می باشد و پس از تایید مدیران می توانید فعالیت خود را در سایت شروع کنید.
            </div>
        @endif
        <div class="row">
            <div class="col-sm-6 mt-3">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$allTransactions}} کیس ها</h5>
                    <a href="{{ route('transaction.index') }}" class="btn btn-primary">مشاهده</a>
                </div>
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{auth()->user()->wallet}}  کیف پول</h5>
                    <a href="{{ route('user.wallet') }}" class="btn btn-primary">شارژ</a>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 mt-3">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$requests}}  سوالات</h5>
                    <a href="{{ route('request.index') }}" class="btn btn-primary">مشاهده</a>
                </div>
                </div>
            </div>
            <div class="col-sm-6 mt-3">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$faildTransactions}}  تراکنش های ناموفق</h5>
                    <a href="{{ route('transaction.index') }}" class="btn btn-primary">مشاهده</a>
                </div>
                </div>
            </div>
        </div>
            
    </div>


@endsection
