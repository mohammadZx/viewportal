@extends('layouts.app')

@section('content')


<div class="card-header">سوالات</div>

<div class="card-body">
    <ul class="list-group mt-3">
        @foreach($requests as $req)
        <li class="list-group-item @if(!$req->status) border border-danger @endif">
            <div class="row">
                <div class="table-responsive col-md-5">
                    <table class="table-bordered">
                        <tr>
                            <th class="p-2">دسته</th>
                            <td class="p-2">{{$req->transaction->optionVar->option->name}} <br> {{$req->transaction->optionVar->name}}</td>
                        </tr>
                        <tr>
                            <th class="p-2">عنوان</th>
                            <td class="p-2">{{$req->title}}</td>
                        </tr>
                        <tr>
                            <th class="p-2">جنس</th>
                            <td class="p-2">{{$req->getMeta('material', true)}}</td>
                        </tr>
                        <tr>
                            <th class="p-2">وزن</th>
                            <td class="p-2">{{$req->getMeta('weight', true)}}</td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive col-md-4">
                    <table class="table-bordered">
                        <tr>
                            <th class="p-2">نام</th>
                            <td class="p-2">{{$req->getMeta('name', true)}}</td>
                        </tr>
                        <tr>
                            <th class="p-2">نژاد</th>
                            <td class="p-2">{{$req->getMeta('race', true)}}</td>
                        </tr>
                        <tr>
                            <th class="p-2">سن</th>
                            <td class="p-2">{{$req->getMeta('age', true)}}</td>
                        </tr>
                    </table>
                </div>
                <div class="table-responsive col-md-3">
                    <table class="table-bordered">
                        <tr>
                            <th class="p-2">
                            <a href="{{route('user.request', $req->id)}}" class="btn btn-primary">مشاهده </a>
                            <br>
                                وضعیت: <a href="#" class="text-danger">{{__('app.'.$req->status)}}</a>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    {{$requests->links()}}
</div>


@endsection