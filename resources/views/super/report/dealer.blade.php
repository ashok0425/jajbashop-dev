@php
       define('PAGE','dealer')
@endphp
@extends('super.master')
@section('main-content')
<div class="container">
    <div class="card">
        <h3>Sales Report</h3>
        <div class="card-body">
    <table id="myTable" class="table table-striped text-center">
<thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th> Email </th>
        <th> Phone</th>
        <th> State</th>
        <th> Address</th>





    </tr>
</thead>
<tbody>


        @foreach ($dealer as $item)
<tr>
    <td>{{$loop->iteration}}</td>

<td>{{$item->name}}</td>

<td>
    {{$item->email}}
</td>
<td>
    {{$item->phone}}
</td>
<td>
    {{$item->state}}
</td>
<td>
    <p class='py-0 mt-1'>{{$item->district}}</p>
    <p class='py-0 mt-1'>{{$item->city}},{{$item->address}}</p>

</td>
</tr>

      @endforeach
    </tbody>
</table>
</div>

    </div>
</div>


@endsection
