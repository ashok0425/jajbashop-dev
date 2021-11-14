
@extends('member.master')

@php
       define('PAGE','account')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">All Level Income Detail</h3>

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
      @php
          $l=$item->index+1
      @endphp
    @if (strtolower($item->$l)==strtolower(Auth::user()->userid))
    <td>Level{{$l}}</td>
    @endif


    <td>Referral level Income for joining of user   <b> {{DB::table('users')->where('id',$item->user_id)->value('userid')}}</b></td>
    <td>{{carbon\carbon::parse($item->created)->format('d F Y')}}</td>

</tr>
@endforeach


    </tbody>
</table>
</div>
    </div>
    <a href="{{route('admin.user.all')}}" class="btn btn-info">Back</a>

</div>
@endsection
