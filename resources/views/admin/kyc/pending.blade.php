@extends('admin.master')

@php
       define('PAGE','kyc')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">Pending Kyc</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>Username</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Created On</th>
        <th>Action</th>


    </thead>
    <tbody>
        @foreach ($kyc as $item)

        <tr>
            <td>{{$loop->iteration}}</td>
    <td>{{$item->userid}}
        <a href="{{route('admin.user.show',['id'=>$item->userid])}}"><i class="fas fa-eye btn-info btn" title="View details"></i>
    </td>

    <td>{{$item->uname}}</td>
    <td>{{$item->account_no}}</td>

<td>
    @if ($item->status==0)
    <div class="badge bg-danger">Pending</div>


    @endif
    @if ($item->status==1)
    <div class="badge bg-danger">Rejected</div>


    @endif
    @if ($item->status==2)
    <div class="badge bg-success">Approved</div>


    @endif
</td>
    <td>{{carbon\carbon::parse($item->updated_at)->format('d F Y')}}</td>
<td>

</a>



<a href="{{route('admin.kyc.show',['id'=>$item->uid])}}"><i class="fas fa-university btn-primary btn" title="View Bank/Kyc details"></i>
</a>

</td>


        </tr>
        @endforeach

</table>
</div>
    </div>

</div>
@endsection
