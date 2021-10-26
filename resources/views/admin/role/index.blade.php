@extends('admin.master')
@php
             define('PAGE','role')

@endphp
@section('main-content')
<div class="container">
    <div class="card py-3 px-4">
        <div class="d-flex justify-content-between">
            <h3> Role And Permisssion Assigned List</h3>
            <a href="{{route('admin.role.create')}}" class="btn btn-info btn-lg" ><i class="fas fa-plus"></i> Create New</a>
        </div>
        <br>

        <table id="myTable" class="table table-responsive table-striped table-bordered " style="border-collapse: collapse" >
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Pemission</th>

                    <th>Status</th>


                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($role as $item)


                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>
                            @if ($item->role==1)
                            <span class="badge bg-success">Role</span>

                            @endif
                            @if ($item->deposite==1)
                            <span class="badge bg-warning">Deposite</span>

                            @endif
                            @if ($item->withdrawal==1)
                            <span class="badge bg-primary">withdrawal</span>

                            @endif
                            @if ($item->profile==1)
                            <span class="badge bg-info">Profile</span>

                            @endif

                            @if ($item->epin==1)
                            <span class="badge bg-info">Epin</span>

                            @endif

                            @if ($item->kyc==1)
                            <span class="badge bg-primary">Kyc</span>

                            @endif
                            @if ($item->user==1)
                            <span class="badge bg-success">user</span>

                            @endif
                            @if ($item->levelprice==1)
                            <span class="badge bg-info">levelprice</span>

                            @endif
                            @if ($item->dashboard==1)
                            <span class="badge bg-danger">dashboard</span>

                            @endif
                        </td>

                        <td>@if ($item->status==1)
                            <a  class="badge bg-success">Active</a>
                            @else
                            <a class="badge bg-danger">Deactive</a>

                        @endif</td>

                        <td>
                            <a href="{{route('admin.role.edit',['id'=>$item->id])}}" class="btn btn-primary"><i class="far fa-edit"></i></a>
@if ($item->status==1)
<a  href="{{route('admin.role.deactive',['id'=>$item->id,'table'=>'admins'])}}" class="btn btn-danger"><i class="fas fa-thumbs-down"></i></a>
@else
<a  href="{{route('admin.role.deactive',['id'=>$item->id,'table'=>'admins'])}}" class="btn btn-danger"><i class="fas fa-thumbs-up"></i></a>
@endif


                        </td>

                    </tr>

                @endforeach
            </tbody>
              </table>
    </div>
</div>



@endsection
@push('scripts')
    <script>

    </script>
@endpush
