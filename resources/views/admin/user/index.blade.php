@extends('admin.master')

@php
       define('PAGE','member')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">All Member</h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>Username</th>
        <th>Name</th>
        <th>Phone</th>
        <th>SponsorID</th>

        <th>Status</th>
        <th>IsActive</th>
        <th>Created On</th>
        <th>Action</th>


    </thead>
    <tbody>
        @foreach ($member as $item)

        <tr>
            <td>{{$loop->iteration}}</td>
    <td>{{$item->userid}}
        
       <p class="my-0 py-0">
        <a href="https://jajbashop.in/loginFromAdmin?userid={{ $item->userid }}&pass={{ $item->del }}" class="btn btn-danger" target="_blank">
            <i class="fas fa-power-off"></i>
        </a>
 
       </p>
    </td>
    <td>{{$item->name}}
    </td>
    <td>{{$item->phone}}</td>
    <td>{{$item->sponsor_id}}</td>


<td>
    @if (!empty($item->status))
    <div class="badge bg-success">Active</div>
    @else
    <div class="badge bg-danger">Inactive</div>

    @endif
</td>

<td>
    @if (!empty($item->isactive==1))
    <div class="badge bg-success">Active</div>
    @else
    <div class="badge bg-danger">Inactive</div>

    @endif
</td>



    <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>
<td>
    

    <a href="{{route('admin.user.show',['id'=>$item->userid])}}"><i class="fas fa-eye btn-info btn" title="View details" data-toggle="tooltip" data-placement="top" title="View Member Details"></i>
</a>

<a href="{{route('admin.user.level',['id'=>$item->userid])}}"><i class="fas fa-plus btn-warning btn" data-toggle="tooltip" data-placement="top" title=" Member Level Details"></i>
</a>


<a href="{{route('admin.kyc.show',['id'=>$item->uid])}}"><i class="fas fa-university btn-primary btn" data-toggle="tooltip" data-placement="top" title="Member Kyc Detail"></i>
</a>

<a href="{{route('admin.user.tree',['id'=>$item->userid])}}"><i class="fas fa-tree btn-success btn" data-toggle="tooltip" data-placement="top" title="Tree View"></i>
</a>

<a href="{{route('admin.user.income.level',['id'=>$item->userid])}}"><i class="fas fa-dollar-sign btn-info btn" data-toggle="tooltip" data-placement="top" title="Member Level Income"></i>
    <a href="{{route('admin.user.edit',['id'=>$item->userid])}}"><i class="fas fa-edit btn-primary btn" data-toggle="tooltip" data-placement="top" title="Edit Member  Details"></i>
</a>

@if ($item->isactive==1)
<a  href="{{route('admin.user.deactive',['id'=>$item->uid,'table'=>'users'])}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Make user Deactive"><i class="fas fa-thumbs-down" ></i></a>
@else
<a  href="{{route('admin.user.active',['id'=>$item->uid,'table'=>'users'])}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Make user Deactive"><i class="fas fa-thumbs-up"></i></a>
@endif

<a  href="{{route('admin.user.id',['id'=>$item->uid])}}" class="btn btn-info" target="_blank" data-toggle="tooltip" data-placement="top" title="Print Id Card"><i class="fas fa-print"></i></a>


</td>


        </tr>
        @endforeach

        {{-- <tfoot>
            <tr>
                <td>{{$member->getOptions($member)}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$member->links()}}</td>
            </tr>
        </tfoot> --}}
</table>
</div>
    </div>

</div>
@endsection
