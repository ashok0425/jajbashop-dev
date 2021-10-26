@php
       define('PAGE','repurchase')
@endphp
@extends('member.master')
@section('main-content')
<div class="container">
    <div class="card">
        <h3>Self BV Income</h3>
        <div class="card-body">
    <table id="myTable" class="table table-striped text-center">
<thead>
    <tr>
        <th>#</th>
        <th> BV </th>
        
        <th> Comission ({{ __getPriceunit()}})</th>
        <th> Date</th>
        <th> Time</th>






    </tr>
</thead>
<tbody>


        @foreach ($income as $item)
<tr>
    <td>{{$loop->iteration}}</td>
    <td>{{$item->bv}}</td>

<td>{{$item->comission}}</td>

<td>
    {{carbon\carbon::parse($item->created_at)->format('d F Y ')}}
    
</td>
<td>
    {{carbon\carbon::parse($item->created_at)->format('h:i:s A')}}
    
</td>

</tr>

      @endforeach
    </tbody>
</table>
</div>

    </div>
</div>


@endsection
