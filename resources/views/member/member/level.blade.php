@extends('member.master')

@php
       define('PAGE','member')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Level wise Member Count</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>

        <th>Level</th>
        <th>No. of Member</th>
        <th>Action</th>


    </thead>
    <tbody>
        {{-- lopping tr for all level and fetching data according to level indexed  --}}
        @for ($i=1;$i<=100;$i++)
        @php
            $l='l'.$i;
        @endphp
        <tr>
            <td>{{ $i }}</td>
            <td>Level {{ $i }}</td>
             <td>
@php
    $member=DB::table('levels')->where("$l",Auth::user()->userid)->get();
@endphp
{{count($member)}}
             </td>

<td><a href="{{route('member.level.show',['level'=>$i])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>
        @endfor
    
</table>
</div>
    </div>
    <a href="{{route('member.all')}}" class="btn btn-info">Back</a>

</div>
@endsection
