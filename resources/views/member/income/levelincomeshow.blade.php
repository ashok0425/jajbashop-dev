@extends('member.master')

@php
       define('PAGE','account')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Earning Detail of Level {{$id}}</h3>

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
    @for ($i=1;$i<=10;$i++)
    @php
        $l='l'.$i;
    @endphp
@if ($id==$i)
<td>{{$item->$l}}</td>
@endif
    @endfor
    
    <td>Referral level Income for joining of user   <b> {{DB::table('users')->where('id',$item->user_id)->value('userid')}}</b></td>
    <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>

</tr>
@endforeach


    </tbody>
</table>
</div>
    </div>
    <a href="{{route('member.income.level')}}" class="btn btn-info">Back</a>

</div>
@endsection



