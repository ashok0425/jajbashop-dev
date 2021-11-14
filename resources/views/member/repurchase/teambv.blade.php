


@extends('member.master')

@php
       define('PAGE','repurchase')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Team BV</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        {{-- <th>Level</th> --}}

        <th>B.v</th>

        <th>Member Userid/Name</th>
        <th>Date</th>


    </thead>
    <tbody>
@foreach ($income as $item)

<tr>
    <td>{{$loop->iteration}}</td>

    <td>
{{-- lopping tr for all level and fetching data according to level indexed  --}}
  @for ($i=1;$i<=100;$i++)
  @php
      $l='l'.$i;
      $e='e'.$l;
  @endphp

@if (strtolower($item->$l)==strtolower(Auth::user()->userid))
<td>{{$item->$e}}</td>
@endif

@endfor
    </td>

    <td>  
        @php
$user=DB::table('users')->where('id',$item->user_id)->first()
        @endphp
         <b> {{$user->userid}}/{{ $user->name }} </b>
        
        </td>
    <td>{{carbon\carbon::parse($item->created)->format('d F Y')}}</td>

</tr>
@endforeach


    </tbody>
</table>
</div>
    </div>

</div>
@endsection
