@extends('admin.master')
@php
       define('PAGE','pin')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">


        <div class="col-md-12 col-xl-12">
<div class="card">
 
<h3 class="">Transfer History</h3>
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>E-pin</th>
        <th>User ID</th>
        <th>Name</th>


        <th>Status</th>
        <th>Package</th>

        <th>Created On</th>



    </thead>
    <tbody>
        @foreach ($pin as $item)

        <tr>
            <td>{{$loop->iteration}}</td>
    <td>{{$item->epin}}</td>
    <td>{{$item->receiver}}</td>

    <td>{{$item->name}}</td>


    <td>
        @if ($item->status=='Unused')
            <span class="badge bg-danger">unused</span>
            @else
            <span class="badge bg-success">used</span>

        @endif
    </td>


    <td>
        @if ($item->package==1)
            <span class="badge bg-info">Package-1000</span>
            @else
            <span class="badge bg-info">Package-650</span>

        @endif
    </td>
    <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>



        </tr>
        @endforeach

</table>
               </div>

            </div>
        </div>
    </div>

</div>
@endsection
