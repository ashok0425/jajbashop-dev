@extends('admin.master')
@php
       define('PAGE','pin')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Unused E-pin</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>User Id</th>
        <th>Name</th>
        <th>Detail</th>
        <th>Qty</th>
        <th>Date</th>
        <th>Action</th>



    </thead>
    <tbody>
        @foreach ($ticket as $item)

        <tr>
            <td>{{$loop->iteration}}}</td>
    <td>{{$item->userid}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->title}}</td>

    <td>{{$item->qty}}</td>

    <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>

    <td><a href="{{route('admin.epin.transfer',['userid'=>$item->userid])}}" class="btn btn-info"><i class="fas fa-location-arrow"></i></a></td>


        </tr>
        @endforeach

</table>
</div>
    </div>

</div>
@endsection
