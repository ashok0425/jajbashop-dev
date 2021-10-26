@extends('member.master')

@php
       define('PAGE','member')
@endphp
@section('main-content')
<div class="container-fluid">




   <div class="card">
    <h3 class=" mb-3">List of member </h3>

       <div class="card-body">
<table id="myTable" class="table table-reponsive table-striped">
    <thead>
        <th>#</th>
        <th>Username</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Level</th>
        <th>Status</th>
        <th>Created On</th>
        <th>Action</th>


    </thead>
    <tbody>
        @foreach ($member as $item)

        <tr>
            <td>{{$loop->iteration}}</td>
    <td>{{$item->userid}}</td>
    <td>{{$item->name}}</td>
    <td>{{$item->phone}}</td>
    <td>
@if ($item->l1==Auth::user()->userid)
Level 1
@endif
@if ($item->l2==Auth::user()->userid)
Level 2
@endif

@if ($item->l3==Auth::user()->userid)
Level 3
@endif
@if ($item->l4==Auth::user()->userid)
Level 4
@endif
@if ($item->l5==Auth::user()->userid)
Level 5
@endif
@if ($item->l6==Auth::user()->userid)
Level 6
@endif
@if ($item->l7==Auth::user()->userid)
Level 7
@endif
@if ($item->l8==Auth::user()->userid)
Level 8
@endif
@if ($item->l9==Auth::user()->userid)
Level 9
@endif
@if ($item->l10==Auth::user()->userid)
Level 10
@endif
@if ($item->l11==Auth::user()->userid)
Level 11
@endif
@if ($item->l12==Auth::user()->userid)
Level 112
@endif
@if ($item->l13==Auth::user()->userid)
Level 13
@endif
@if ($item->l14==Auth::user()->userid)
Level 14
@endif
@if ($item->l15==Auth::user()->userid)
Level 15
@endif
    </td>
    <td>
        @if (!empty($item->status))
        <div class="badge bg-success">Active</div>
        @else
        <div class="badge bg-danger">Inactive
            <span type="button" class="btn btn-primary active_btn" data-toggle="modal" data-target="#exampleModal" data-id="{{$item->userid}}">
                Active Now
            </span>
        </div>

        @endif
    </td>
    <td>{{carbon\carbon::parse($item->created_at)->format('d F Y')}}</td>
<td><a href="{{route('member.member.show',['id'=>$item->userid])}}"><i class="fas fa-eye btn-info btn"></i></a></td>


        </tr>
        @endforeach

</table>
</div>
    </div>

</div>


<!-- Button trigger modal -->


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
        <form action="{{route('member.activation')}}" method="POST">
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
    url:'{{url('loadepin')}}/',
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
