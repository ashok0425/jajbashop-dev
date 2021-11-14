@extends('member.master')

@php
       define('PAGE','account')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Level wise Earning Detail</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>

        <th>Level</th>
        <th>Total Earning</th>
        <th>Action</th>


    </thead>
    <tbody>

  {{-- lopping tr for all level and fetching data according to level indexed  --}}
  @for ($i=1;$i<=10;$i++)
  @php
      $l='l'.$i;
  @endphp
  {{-- table row start  --}}
  <tr>
      <td>{{ $i }}</td>
      <td>Level {{ $i }}</td>
       <td>
@php
    $member=DB::table('levels')->join('levelearnings','levelearnings.user_id','levels.user_id')->where('levels.'.$l,Auth::user()->userid)->sum('levelearnings.'.$l);

@endphp
{{$member}}
       </td>

<td>
    <a href="{{route('member.income.level.show',['level'=>$i])}}"><i class="fas fa-eye btn-info btn"></i></a>
</td>

  </tr>
    {{-- table row end  --}}
  @endfor


    </tbody>
</table>
</div>
    </div>
    <a href="{{route('member.income.level')}}" class="btn btn-info">Back</a>

</div>
@endsection
