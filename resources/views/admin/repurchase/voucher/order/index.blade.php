@extends('admin.master')
@section('main-content')
@php
    define('PAGE','order')
@endphp

<div class="container">
    <div class="container">
        {{-- <div class="card pt-1 pb-3 px-2">
       
            <form action="" method="GET">
                @csrf
            <div class="row">
                <div class="col-md-4">
                    <label>Voucher</label>
                    <select name="vendor"  class="vendor form-control">
                        <option readonly value="">--select Voucher Type--</option>
                        <option value="100" >100</option>
                        <option value="500" >500</option>

                            
    
                       </select>
                </div>
                <div class="col-md-2">
                    <label>Payment Type</label>
                    <select name="payment"  class="payment form-control">
                        <option value="cod" >COD</option>
                        <option value="prepaid" >Prepaid</option>
    
                       </select>
                </div>
        
       
                <div class="col-md-2">
                    <label>Date From</label>
                    <input type="date" name="from" id="from" class="form-control"  value="<?php echo date('Y-m-d'); ?>" >
                </div>
                <div class="col-md-2">
                    <label>Date To</label>
                    <input type="date" name="to" id="to" class="form-control"   value="<?php echo date('Y-m-d'); ?>"  >
                </div>
                <div class="col-md-2">
                    <label ></label>
                    <input type="button"  id="search" class="btn btn-danger form-control mt-2" value="search">
                        
                </div>
              
    
            </div>
        </form>
        </div> --}}

    <div class="card py-3 px-4">
        @if ($status==0)
        <h3>Pending Order</h3>
        @endif

        @if ($status==1)
        <h3>Processing Order</h3>
        @endif

        @if ($status==2)
        <h3>Shipped Order</h3> 
        @endif

        @if ($status==3)
        <h3>Delivered Orded</h3>    
        @endif

        @if ($status==4)
        <h3>Cancel Order</h3> 
        @endif
        @if ($status==5)
        <h3>All Order</h3> 
        @endif
        <br>

        <div class="data responsive">
            <table id="myTable" class="table table-responsive-sm " >
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Userid </th>
                        <th class="text-center">Name</th>
                        <th class="text-center"> Vocuher Type</th>
                        <th class="text-center"> Date</th>                  
                        <th class="text-center"> Status</th>

                        <th class="text-center">Action</th>
    
                    </tr>
                </thead>
                <tbody>
    
                    @foreach ($order as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td>
                            <td class="text-center">{{$item->userid}}</td>

                            <td class="text-center">{{$item->name}}</td>
                            <td class="text-center">{{$item->voucher}}</td>

                            <td class="text-center">{{carbon\carbon::parse($item->created_at)->format('d M Y')}}</td>
                           
                            <td class="text-center">
                                 @if ($item->status==0)
                                <span class='badge bg-danger' href="">Pending</span>
                                @endif
                                @if ($item->status==1)
                                <span class='badge bg-info' href="">Accept</span>
                                @endif
                                @if ($item->status==2)
                                <span class='badge bg-primary' href="">Shipping</span>
                                @endif
                                @if ($item->status==4)
                                <span class='badge bg-danger' href="">Cancel</span>
                                @endif
                                @if ($item->status==3)
                                <span class='badge bg-info' href="">Delivered</span>
                                @endif
                                @if ($item->status==5)
                                <span class='badge bg-info' href="">Refund Request</span>
                                @endif
                                @if ($item->status==6)
                                <span class='badge bg-info' href="">Refunded</span>
                                @endif

                            </td> 
                

                        <td>
                            {{-- showing change satus url on bassis status  --}}
                            @if ($item->status==0)
                            <form action="{{ route('admin.order.status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $item->id }}">
                                <input type="hidden" name="status_id" value="1">
                        
                                <input type="submit" class="btn btn-sm bg-success " value="Accept">
                            </form>     
                            <br>                    
                             <form action="{{ route('admin.order.status')}}" method="POST">
                                 @csrf
                                 <input type="hidden" name="order_id" value="{{ $item->id }}">
                                 <input type="hidden" name="status_id" value="4">
                                 <input type="submit" class="btn btn-sm bg-danger " value="Cancel">
                             </form>
                            <br>
                             @elseif($item->status==1)
                             <form action="{{ route('admin.order.status')}}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $item->id }}">
                                <input type="hidden" name="status_id" value="2">
                                <input type="submit" class="btn btn-sm bg-info " value="Shipping">
                            </form>
<br>
                            @elseif($item->status==2)
                            <form action="{{ route('admin.order.status')}}" method="POST">
                               @csrf
                               <input type="hidden" name="order_id" value="{{ $item->id }}">
                               <input type="hidden" name="status_id" value="3">
                               <input type="submit" class="btn btn-sm bg-success " value="Delivered">
                           </form>

                             @endif

                         

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
  <div class="modal fade" id="callforpickup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Product Dimension</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.order.status') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <input type="hidden" name="order_id" value="" id="order_id">
                <input type="hidden" name="vendor_order_id" value="" id="vendor_order_id">
                <input type="hidden" name="status_id" value="2" id="">

  <div class="row py-3 px-1">

      <div class="col-md-3 text-center">
        <label >width (cm)</label>

          <input type="text" name="width" class="form-control">
      </div>
      <div class="col-md-3 text-center">
        <label >height (cm)</label>

          <input type="text" name="height"  class="form-control">
      </div>
      <div class="col-md-3 text-center" >
        <label >length (cm)</label>

        <input type="text" name="length" class="form-control">
    </div>
    <div class="col-md-3 text-center" >
        <label >Weight (Kg)</label>

        <input type="text" name="weight" class="form-control">
    </div>
    <div class="col-md-12 text-center" >
<br>
        <input type="file" name="file"  class="form-control">
    </div>
    
    <div class="col-md-12">
        <input type="submit" value="Call to pickup" class="btn btn-info mt-4 d-block btn-block">
    </div>
    
  </div>

</form>

        </div>
      
      </div>
    </div>
  </div>





  <!-- price calculation modal  Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">All Price Calculation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal_body">
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

// search vendor 
$(document).on('click','#search',function(e) {
    e.preventDefault()
   let _token=$('meta[name=csrf-token]').attr('content')
 let $from=$('#from').val();
 let $to=$('#to').val();
 let $payment_mode=$('.payment').val();
 let $vendor=$('.vendor').val();
let $status={{ $status }}
$.ajax({
    url:'{{ url('admin/order/filter/list') }}/',
    type:'GET',
    dataType:'html',
    data:{from:$from,to:$to,payment_mode:$payment_mode,status:$status,vendor:$vendor,_token:_token},
    
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
         url:'{{ url('admin/loadcalc-detail') }}/'+id,
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


<script>
   $('.invoice_print').click(function()
{
    order_id=$(this).data('order_id');
    vendor_order_id=$(this).data('vendor_order_id');
    $.ajax({
        url:'{{ url('admin/print-invoice') }}/'+order_id+'/'+vendor_order_id,
        dataType:'html',
        type:'GET',
        beforeSend:function(){
        $(window).html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");


	},
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
</script>
@endpush