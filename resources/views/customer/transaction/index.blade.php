@extends('layouts.app')

@section('content')


<div class="card-header">تراکنش ها</div>

<div class="card-body">
    <ul class="list-group mt-3">
        @foreach($transactions as $tr)
        <li class="list-group-item @if(!$tr->status) border border-danger @endif">
            <div class="row">
                <div class="table-responsive col-md-5">
                    <table class="table-bordered">
                        <tr>
                            <th class="p-2">نام</th>
                            <td class="p-2">{{$tr->optionVar->option->name}}</td>
                        </tr>
                        <tr>
                            <th class="p-2">نوع کارشناس</th>
                            <td class="p-2">{{$tr->optionVar->name}}</td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive col-md-4">
                    <table class="table-bordered">
                        <tr>
                            <th class="p-2">نوع بررسی</th>
                            <td class="p-2">{{$tr->optionType->name}}</td>
                        </tr>
                        <tr>
                            <th class="p-2">قیمت</th>
                            <td class="p-2">{{$tr->price}}</td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive col-md-3">
                    <table class="table-bordered">
                        <tr>
                            <th class="p-2">
                                @if($tr->request)
                                <a href="{{route('user.request', $tr->request->id)}}" class="btn btn-primary">مشاهده سوال</a>
                                @else
                                <a href="{{route('user.question_request', $tr->id)}}" class="btn btn-primary">ثبت سوال</a>
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <th class="p-2">
                                کد تخفیف: {{$tr->coupon}}
                            </th>           
                        </tr>
                        <tr>
                            @canany(['admin','superadmin'])
                            <th class="p-2">
                                @can('delete-user')
                                    <form method="post" action="{{route('transaction.destroy', $tr->id)}}" class="confirm">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                @endcan
                            </th>   
                            @endcan
                        </tr>
                    </table>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {{$transactions->links()}}
</div>


@endsection