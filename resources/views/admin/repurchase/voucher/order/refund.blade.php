@extends('admin.master')
@section('main-content')
@php
    define('PAGE','order')
@endphp

<div class="container">
    <div class="container">
        <div class="card pt-1 pb-3 px-2">
            <form action="" method="GET">
                @csrf
            <div class="row">
          
                <div class="col-md-3">
                    <label>Payment Type</label>
                    <select name="payment"  class="payment form-control">
                        <option value="cod" >COD</option>
                        <option value="prepaid" >Prepaid</option>
    
                       </select>
                </div>
        
       
                <div class="col-md-3">
                    <label>Date From</label>
                    <input type="date" name="from" id="from" class="form-control"  value="<?php echo date('Y-m-d'); ?>" >
                </div>
                <div class="col-md-3">
                    <label>Date To</label>
                    <input type="date" name="to" id="to" class="form-control"   value="<?php echo date('Y-m-d'); ?>"  >
                </div>
                <div class="col-md-3">
                    <label ></label>
                    <input type="button"  id="search" class="btn btn-danger form-control mt-2" value="search">
                        
                </div>
              
    
            </div>
        </form>
        </div>

    <div class="card py-3 px-4">
   <h4> Refund Order Request</h4>
        <br>

        <div class="data">
            <table id="myTable" class="table table-responsive-sm " >
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">order Id</th>
                        <th class="text-center">Vendor <br> order <br> Id</th>
                        <th class="text-center">Refund Reason</th>
                        <th class="text-center"> Status</th>
                        <th class="text-center">Action</th>
    
                    </tr>
                </thead>
                <tbody>
    
                    @foreach ($order as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$item->order_id}}</td>

                            <td class="text-center">{{$item->vendor_order_id}}</td>
                          
                       
                            <td class="text-center">
                                {{$item->refund_reason}}
                            </td> 
                        
                                <td class="text-center">
                                    @if ($item->status==5)
                                    <span class='badge bg-info' href="">Refund Request</span>
                                    <br>
                                    <form action="{{ route('vendor.order.status')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{ $item->order_id }}">
                                        <input type="hidden" name="vendor_order_id" value="{{ $item->vendor_order_id }}">
                                        <input type="hidden" name="status_id" value="6">
    
                                        <button type="submit" class="btn btn-sm bg-success refunded" >
                                            Order Refunded
                                        </button>
                                    </form>
                                    @endif

                                    @if ($item->status==6)
                                    <span class='badge bg-success' href="">Refunded</span>
                                    @endif
                              
                                    
                            </td>
                                    <td class="text-center">
                                        <a href="#" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $item->vendor_order_id }}" class="calc btn btn-primary btn-sm">
                                            <i class="fas fa-calculator "></i></a>
                                        <a  data-id="{{ $item->order_id }}" class="invoice_print btn btn-danger btn-sm" data-order_id="{{ $item->order_id }}" data-vendor_order_id="{{ $item->vendor_order_id }}">
                                            <i class="fas fa-print "></i>
                                        </a>
                 
                                    </td>
                        </tr>
                    @endforeach
                </tbody>
                  </table>
        </div>
    </div>
</div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">All Price Calculation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>

        </div>
      
      </div>
    </div>
  </div>


@endsection


@push('scripts')
<script>
$('.refunded').mouseover(function(){
    alert('Click  button only when you get your product back.Once you clicked,it means product is delivered back to you ')
})
// search vendor 
$(document).on('click','#search',function(e) {
    e.preventDefault()
   let _token=$('meta[name=csrf-token]').attr('content')
 let $from=$('#from').val();
 let $to=$('#to').val();
 let $payment_mode=$('.payment').val();
let $status={{ $status }}
$.ajax({
    url:'{{ url('vendor/order/filter/list') }}/',
    type:'GET',
    dataType:'html',
    data:{from:$from,to:$to,payment_mode:$payment_mode,status:$status,_token:_token},
    
    beforeSend:function(){
        $(".data").html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");


	},
	 success:function(data){
		$(".data").html(data);

  },
})


})


</script>

<script>
    $('.calc').click(function(){
     let id=$(this).data('id');
     $.ajax({
         url:'{{ url('vendor/loadcalc-detail') }}/'+id,
         type:'GET',
         dataType:'html',
         beforeSend:function(){
        $(".modal-body").html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");


	},
			 success:function(data){
		$(".modal-body").html(data);
         

  },
     })
    })



$('.call_for_pickup').click(function(){
    $order_id=$(this).data('order_id')
    $vendor_order_id=$(this).data('vendor_order_id')
    $width=$(this).data('width')
    $height=$(this).data('height')
    $length=$(this).data('length')

    $('#order_id').val($order_id)
    $('#vendor_order_id').val($vendor_order_id)
    $('#width').val($width)
    $('#height').val($height)
    $('#length').val($length)


   
})
</script>
@endpush