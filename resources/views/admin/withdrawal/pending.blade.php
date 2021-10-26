
@extends('admin.master')


@php
       define('PAGE','withdrawal')
@endphp
@section('main-content')
<div class="container-fluid">


    <div class="row">


        <div class="col-md-12 col-xl-12">
<div class="card">
                    <h3 class=" mb-0">Pending Withdrawal List</h3>


        <div class="card-body">




            <table id="myTable" class="table scroll reponsive striped">
                <thead>
                    <th>#</th>
                    <th>User</th>
                    <th>Account </th>
                    <th> Amount</th>
                    <th>Admin Remark</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>



                </thead>
                <tbody>
                    @foreach ($withdrawal as $item)

                    <tr>
                        <td>{{$loop->iteration}}</td>
                <td>{{$item->userid}}
                    <p>{{$item->name}}</p>
    <a href="{{route('admin.user.show',['id'=>$item->userid])}}"><i class="fas fa-eye btn-info btn" title="View details"></i>



                <td><p class="py-0 my-0">IFSC:{{$item->ifsc}}</p>
                {{$item->account_no}}</td>
                <td><p class="py-0 my-0">RA: {{$item->amount}}</p>
                PA: {{$item->paying_amount}}</td>

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


                <td>{{carbon\carbon::parse($item->created_at)->format('d M Y')}}</td>

                <td>
                    <span type="button" class="btn btn-primary active_btn" data-toggle="modal" data-target="#exampleModal" data-id="{{$item->id}}">
                        <i class="fas fa-edit"></i>
                    </span>
                               </td>

                    </tr>
                    @endforeach

            </table>
        </div>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Change Status of withdrawal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.user.withdrawal.request.updated')}}" method="POST">
            @csrf
            <input type="hidden"  id="id"  name="id">
        <div class="modal-body">
<div class="form-group">
    <label for="">Remark</label>
<input type="text" class="form-control" name="remark"  id="epin">

</div>
<div class="form-group">
    <label for="">Status</label>
<select name="status" id="" class="form-control">
    <option value="0">Pending</option>
    <option value="2">Approve</option>
    <option value="1">Reject</option>

</select>

</div>
<br>
<input type="submit" value="submit" class="form-control">
        </div>
    </form>

      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
     $('.active_btn').click(function(){
         $userid=$(this).data('id');
         $('#id').val($userid);
        //  $('#epin').val($userid);

     })
    })
</script>

@endpush
