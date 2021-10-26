@extends('admin.master')
@php
       define('PAGE','levelprice')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Level Price List</h3>
       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
       <tr>
        <th>#</th>
        <th>Level</th>
        <th>Price</th>
        <th>Package</th>

        <th>Action</th>
       </tr>



    </thead>
    <tbody>
        @foreach ($level as $item)

        <tr>
     <td>{{$loop->iteration}}</td>
    <td>Level {{$item->level}}</td>
    <td>{{$item->price}} </td>
    <td>
        @if ($item->package==1)
            Pacakge1000
        @elseif($item->package==0)
        Pacakge650
        @endif
    </td>

    <td><a href="{{route('admin.level.price.edit',['id'=>$item->id])}}" class="btn btn-primary"><i class="fas fa-edit"></i></a></td>




        </tr>
        @endforeach

</table>
</div>
    </div>

</div>
@endsection
