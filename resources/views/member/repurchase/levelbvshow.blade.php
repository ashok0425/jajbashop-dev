@extends('member.master')

@php
       define('PAGE','repurchase')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">BV Detail of Level {{$id}}</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>Total BV</th>

        <th>Current Month BV</th>

        <th>Member Userid/Name</th>
        <th>Last Purchase Date</th>


    </thead>
    <tbody>
@foreach ($income as $item)

<tr>
    <td>{{$loop->iteration}}</td>
 {{-- TOTAL BV FROM SELECTED USER  --}}
    <td>
    {{ DB::table('orders')->where('buyer',1)->where('user_id',$item->user_id)->sum('bv')}}
    </td>

 {{-- CURRENT MONTH BV FROM SELECTED USER  --}}
    <td>  
        {{ DB::table('orders')->where('buyer',1)->where('user_id',$item->user_id)->whereMonth('created_at',date('m'))->sum('bv')}}
    </td>

    <td>
@php
    $user=DB::table('users')->where('id',$item->user_id)->first();
@endphp
 {{ $user->userid }}/ {{ $user->name }}
    </td>

 {{-- LAST PURCHASE DATE  --}}
@php
        $last= DB::table('orders')->where('buyer',1)->where('user_id',$item->user_id)->latest()->first();
@endphp
    <td>{{carbon\carbon::parse($last->created_at)->format('d F Y')}}</td>

</tr>
@endforeach


    </tbody>
</table>
</div>
    </div>
    <a href="{{route('member.income.level')}}" class="btn btn-info">Back</a>

</div>
@endsection



