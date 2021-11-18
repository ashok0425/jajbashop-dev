@php
       define('PAGE','super')
@endphp
@extends('admin.master')
@section('main-content')
<div class="container">
    <div class="card">
        <h3>Sales Report of Super Distributor {{ $super->email }}</h3>
        <div class="card-body">
    <table id="myTable" class="table table-striped text-center">
<thead>
    <tr>
        <th>#</th>
        <th>Order ID</th>
        <th> Amount {{__getPriceunit()}}</th>
        <th> BV</th>
        <th> Comission</th>

        <th>Action</th>




    </tr>
</thead>
<tbody>


        @foreach ($order as $item)
<tr>
    <td>{{$loop->iteration}}</td>

<td>{{$item->order_id}}</td>

<td>
    {{$item->total}}
</td>
<td>
    {{$item->bv}}
</td>
<td>
    {{$item->comission}}
</td>
<td>
    <a href="{{route('admin.distributor.order.show',['id'=>$item->id,'orderId'=>$item->order_id])}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
    <button class="btn btn-danger mr-2 d_in_win openWin" data-id="{{ $item->id }}"><i class="fas fa-print"></i> Print</button>
    <a href="{{route('admin.distributor.order.print',['id'=>$item->id,'orderId'=>$item->order_id])}}" class="btn btn-danger mr-2 "><i class="fas fa-download"></i> Download</a>


</td>
</tr>

      @endforeach
    </tbody>
</table>
</div>
<a href="{{route('admin.distributor')}}" class="btn btn-info">Back</a>

    </div>
</div>


@endsection




@push('scripts')
<script>
    $('.openWin').click(function openWin()
 {
     id=$(this).data('id')
     $.ajax({
         url:'{{ url('admin/supers/order/print') }}/'+id,
         dataType:'html',
         type:'GET',
         success:function($data){
             myWindow=window;
             myWindow.document.write($data);
             myWindow.focus();
             myWindow.print(); 
             myWindow.close(); //missing code
             location.reload()
 
         }
     })
 
  
 })
let width=$(window).width();
 if(width>=1000){
    $('.d_in_win').removeClass('d-none')
     $('.d_in_win').addClass('d-inline')
 }else{
    $('.d_in_win').removeClass('d-block')
    $('.d_in_win').addClass('d-none')

 }
 </script>
 
@endpush