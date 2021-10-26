
@extends('member.master')

@php
       define('PAGE','deposite')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">


        <div class="col-md-12 col-xl-12">
<div class="card">
                    <h3 class=" mb-0">Rejected Deposite List</h3>


        <div class="card-body">




            <table id="myTable" class="table table-reponsive table-striped">
                <thead>
                    <th>#</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>User Remark</th>
                    <th>Admin Remark</th>


                    <th>Status</th>

                    <th>Date</th>



                </thead>
                <tbody>
                    @foreach ($deposite as $item)

                    <tr>
                        <td>{{$loop->iteration}}</td>
                <td>{{$item->userid}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->amount}}</td>
                <td>{{$item->user_remark}}</td>
                <td>{{$item->admin_remark}}</td>

                <td>
                    @if ($item->status==0)
                    <div class="badge bg-danger">Pending</div>

                    @elseif($item->status==2)
                    <div class="badge bg-success">Approved</div>

                    @else
                    <div class="badge bg-info">Rejected</div>

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
