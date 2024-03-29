@extends('admin.master')

@php
       define('PAGE','super')
@endphp
@section('main-content')
<div class="container-fluid">

   <div class="card">
    <h3 class=" mb-3">Distributor List of Super Distributor {{ $super->email }}</h3>

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
        @foreach ($dist as $item)

        <tr>
            <td>{{$loop->iteration}}</td>
    <td>{{$item->email}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->phone}}</td>

<td>
    @if (!empty($item->status))
    <div class="badge bg-success">Active</div>
    @else
    <div class="badge bg-danger">Inactive
        
    </div>

    @endif
</td>
    <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>
    <td>
      <a href="{{route('admin.distributor.show',['id'=>$item->id])}}" data-toggle="tooltip" data-placement="top" title="Super distributor detail" class="btn-info btn"><i class="fas fa-eye "></i>
      </a>
  
     
      <a href="{{route('admin.distributor.sales',['id'=>$item->id])}}" data-toggle="tooltip" data-placement="top" title="Sales Report" class="btn-info btn"><i class="fas fa-dollar-sign"  ></i>
      </a>
  
      <a href="{{route('admin.distributor.purchase',['id'=>$item->id])}}" data-toggle="tooltip" data-placement="top" title="Purchase Report" class="btn-primary btn"><i class="fas fa-dollar-sign"  ></i>
      </a>
  
      <a href="{{route('admin.distributor.edit',['id'=>$item->id])}}" data-toggle="tooltip" data-placement="top" title="Edit Super distributor" class="btn-info btn"><i class="fas fa-edit"  ></i>
      </a>
  
      @if ($item->status==1)
      <a  href="{{route('admin.distributor.deactive',['id'=>$item->id,'table'=>'distributors'])}}" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Deactive SuperD"><i class="fas fa-thumbs-down"></i></a>
      @else
      <a  href="{{route('admin.distributor.active',['id'=>$item->id,'table'=>'distributors'])}}" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Active SuperD"><i class="fas fa-thumbs-up"></i></a>
      @endif
  </td>


        </tr>
        @endforeach

</table>
</div>
<a href="{{route('admin.super')}}" class="btn btn-info">Back</a>

    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enter Activation E-pin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('admin.user.activation')}}" method="POST">
            @csrf
            <input type="hidden"  id="userid"  name="userid">
        <div class="modal-body">
<div class="form-group">
<input type="text" class="form-control" name="epin"  id="epin" autocomplete="off">
<div class="epindata"></div>
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

     $(document).on('click','.active_btn',function(){

         $userid=$(this).data('id');

         $('#userid').val($userid);
        //  $('#epin').val($userid);

     })

$('#epin').click(function(){
$.ajax({
    url:'{{url('admin/loadepin')}}/',
    type:"GET",
    dataType:'json',
    success:function(data){
      console.log(data);
      $('.epindata').html(data);
    }
})
})

$(document).on('click','.pincode',function(){
    let near=$(this).children('.pincodeinner').html();
$('#epin').val(near)
$('.epindata').html('');

})
    })
    </script>
@endpush

