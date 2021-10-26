@extends('admin.master')

@php
       define('PAGE','member')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Earning Detail of Level {{$id}} of username {{$userid}}</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>Level</th>
        <th>Amount</th>

        <th>Detail</th>
        <th>Date</th>


    </thead>
    <tbody>
@foreach ($income as $item)

<tr>
    <td>{{$loop->iteration}}</td>

    <td>Level {{$id}}</td>

    @if ($id==1)
    <td>{{$item->l1}}</td>
    @endif
    @if ($id==2)
    <td>{{$item->l2}}</td>
    @endif
    @if ($id==3)
    <td>{{$item->l3}}</td>
    @endif
    @if ($id==4)
    <td>{{$item->l4}}</td>
    @endif
    @if ($id==5)
    <td>{{$item->l5}}</td>
    @endif
    @if ($id==6)
    <td>{{$item->l6}}</td>
    @endif
    @if ($id==7)
    <td>{{$item->l7}}</td>
    @endif
    @if ($id==8)
    <td>{{$item->l8}}</td>
    @endif
    @if ($id==9)
    <td>{{$item->l9}}</td>
    @endif
    @if ($id==10)
    <td>{{$item->l10}}</td>
    @endif
    <td>Referral level Income for joining of user   <b> {{DB::table('users')->where('id',$item->user_id)->value('userid')}}</b></td>
    <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>

</tr>
@endforeach


    </tbody>
</table>
</div>
    </div>
    <a href="{{route('admin.user.all')}}" class="btn btn-info">Back</a>

</div>
@endsection



