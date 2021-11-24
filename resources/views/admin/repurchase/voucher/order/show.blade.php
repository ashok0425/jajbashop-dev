@extends('admin.master')
@section('main-content')
{{ define('PAGE','order')}}
<style>
    th,td{
        padding-left: 1rem;
        border:1px solid gray;
        text-align: center;
    }
</style>

<div class="container ">
   
    <div class="row">

       <div class="col-md-4">

           <div class="card shadow">
            <div class="card-header bg-gray font-weight-bold">
                SELLER INFO
            </div>
               <div class="card-body">

                <table class="table">
                    <tr>
                        <th> Name</th>
                        <td>{{ $seller->name }}</td>
                    </tr>
                    <tr>
                        <th> Email</th>
                        <td>{{ $seller->email }}</td>
                    </tr>
                    <tr>
                        <th> Phone</th>
                        <td>{{ $seller->phone }}</td>
                    </tr>
                    <tr>
                        <th> State</th>
                        <td>{{ $seller->company_state }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $seller->company_city }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $seller->company_address }}</td>
                    </tr>
                  
                    <tr>
                        <th>Pincode</th>
                        <td>{{ $seller->company_pincode }}</td>
                    </tr>
                 
      
                </table>
            </div>

           </div>
       </div>
       <div class="col-md-4">

        <div class="card shadow ">
            <div class="card-header bg-gray font-weight-bold">
                BUYER INFO
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th> Name</th>
                        <td>{{ $buyer->name }}</td>
                    </tr>
                    <tr>
                        <th> Email</th>
                        <td>{{ $buyer->email }}</td>
                    </tr>
                    <tr>
                        <th> Phone</th>
                        <td>{{ $buyer->phone }}</td>
                    </tr>
                    <tr>
                        <th> State</th>
                        <td>{{ $buyer->state }}</td>
                    </tr>
                 
                    <tr>
                        <th>City</th>
                        <td>{{ $buyer->city }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $buyer->address }}</td>
                    </tr>
                    <tr>
                        <th>Pincode </th>
                        <td>{{ $buyer->zip }}</td>
                    </tr>
                 
      
                </table>
            
        </div>

        </div>
    </div>
<div class="col-md-4">
        <div class="card shadow">
            <div class="card-header bg-gray font-weight-bold">
              Grand  Total of All Order having OrderID {{ $order->order_id }}
            </div>
<div class="card-body">

            <table class="table">
                <tr>
                    <th>Order Id</th>
                    <td>{{ $order->order_id }}</td>
                </tr>
             
                <tr>
                 <th>Payment Type</th>
                 <td>{{ $order->payment_type }}</td>
             </tr>
                <tr>
                 <th>Payment Id</th>
                 <td>{{ $order->payment_id }}</td>
             </tr>
             <tr>
                 <th>Cart Value</th>
                 <td>{{__getPriceunit()}} {{  number_format($order->total-$order->shipping_charge+$order->coupon_value,2) }}</td>
             </tr>
             <tr>
                 <th>Shipping</th>
                 <td>+ {{__getPriceunit()}} {{ number_format($order->shipping_charge,2) }}</td>
             </tr>
           @if ($order->coupon!==null)
               
             <tr>
                 <th>Coupon({{ $order->coupon }})</th>
                 <td> -{{ __getPriceunit() }} {{ $order->coupon_value }}</td>
             </tr>
           @endif

             <tr>
                 <th>Grand Total</th>
                
                 <td>{{__getPriceunit()}} {{ number_format($order->total,2) }}</td>
             </tr>
             

            </table>
</div>

    </div>


</div>    
</div>    



   <div class="card mt-3 shadow px-4 py-2 " >
       <h3>Product Details of all product having orderID {{ $order->order_id }}</h3>
       <table class="table table-responsive-sm table-striped">
<thead>
    <th>ID</th>

    <th>Image</th>
    <th>Name</th>
    <th>Price(per item) ({{ __getPriceunit() }})</th>
    <th>Delivery (per item)<br> Charge ({{ __getPriceunit() }})</th>

    <th>Qty</th>
    <th>Detail</th>

</thead>
<tbody>
    <tr>
        <td>
            {{ $item->vendor_order_id }}
        </td>
    <td>
       <img src=" {{ asset($item->image) }}" alt="Product image" class="img-fluid" width="80" style="height:100px">
    </td>
    <td>
        {{ $item->name }}
        <p>
            @if ($item->color)
       <div class="d-flex align-items-center justify-content-center">
        Color: <div class="color mx-1" style="background: {{ $item->color }};width:30px;height:15px;"></div></p>
    </div> 
            @endif
            @if ($item->size)
            <p>
                Size: {{ $item->size }}</p>
                    
                @endif
        
    </td> 
   
   
    <td>
   {{ $item->price}}
    </td>

    <td>
        {{ $item->charge}}
         </td>

    <td>
        {{ $item->qty }}
    </td>

    <td>
        <a href="#" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $item->vendor_order_id }}" class="calc btn btn-primary btn-sm">
                                            <i class="fas fa-calculator "></i></a>
    </td>
</tr>
   
</tbody>
       </table>
   </div>
</div>

<!-- Button trigger modal -->

  
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
</script>
@endpush
