@extends('admin.master')

@php
       define('PAGE','super')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">All  Distributor</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>Email</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Created On</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($super as $item)
        <tr>
            <td>{{$loop->iteration}}</td>
    <td>{{$item->email}}
    <form action="{{route('admin.distributor.login')}}" method="POST">
        @csrf
    <input type="hidden" name="email" value="{{$item->email}}">
    <input type="hidden" name="password" value="{{$item->del}}">
<button class="btn btn-danger"><i class="fas fa-power-off"></i></button>
    </form>
    </td>
    <td>{{$item->name}}</td>
    <td>{{$item->phone}}</td>

    <td>
        @if ($item->status==1)
        <div class="badge bg-success">Active</div>
       
        @else 
        <div class="badge bg-danger">Block</div>
    
        @endif
    </td>

<td>{{carbon\carbon::parse($item->created_at)->format('d M Y')}}</td>
<td>
    <a href="{{route('admin.distributor.show',['id'=>$item->id])}}" data-toggle="tooltip" data-placement="top" title="Distributor detail" class="btn-info btn"><i class="fas fa-eye "></i>
    </a>

 

    <a href="{{route('admin.distributor.sales',['id'=>$item->id])}}" data-toggle="tooltip" data-placement="top" title="Sales Report" class="btn-info btn"><i class="fas fa-dollar-sign"  ></i>
    </a>

    <a href="{{route('admin.distributor.purchase',['id'=>$item->id])}}" data-toggle="tooltip" data-placement="top" title="Purchase Report" class="btn-primary btn"><i class="fas fa-dollar-sign"  ></i>
    </a>

    <a href="{{route('admin.distributor.edit',['id'=>$item->id])}}" data-toggle="tooltip" data-placement="top" title="Edit Super distributor" class="btn-info btn"><i class="fas fa-edit"  ></i>
    </a>

    @if ($item->status==1)
    <a  href="{{route('admin.distributor.deactive',['id'=>$item->id,'table'=>'distributors'])}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactive Distributor"><i class="fas fa-thumbs-down"></i></a>
    @else
    <a  href="{{route('admin.distributor.active',['id'=>$item->id,'table'=>'distributors'])}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Active Distributor"><i class="fas fa-thumbs-up"></i></a>
    @endif
</td>
</tr>
        @endforeach
       
</table>
</div>
    </div>

</div>
@endsection
