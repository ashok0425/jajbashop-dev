@extends('frontend.master')
@section('content')

<style>
    th,td{
        padding-left: 1rem;
        border:1px solid gray;
        text-align: center;
    }
</style>
<div class="container-fluid">
<div class=" mb-3 card">
    <div class="row py-1 py-md-3">
        <div class="col-md-6">
            <h4>Order Details of order ID {{ $order->tracking_code }}</h4>
        </div>
      <div class="col-6 col-md-3">
        <a href="{{ route('order') }}" class="btn custom-bg-secondary text-white "><i class="fas fa-arrow-left"></i> Back</a>

      </div>
      <div class="col-md-3 col-6">
        <a href="#" onclick="openWin()" class="btn  text-white bg-danger"><i class="fas fa-print"></i> Print</a>
          
      </div>

    </div>
   
   </div>
<div class="container my-5">
    
   <div class="row">
      

       <div class="col-md-6 ">

           <div class="card shadow-sm">
<div class="card-body">

               <table class="table">
                   <tr>
                       <th>Order Id</th>
                       <td>{{ $order->tracking_code }}</td>
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
                    <td>{{__getPriceunit()}} {{  number_format($order->total-$order->shipping_charge,2) }}</td>
                </tr>
                <tr>
                    <th>Shipping</th>
                    <td>{{__getPriceunit()}} {{ number_format($order->shipping_charge,2) }}</td>
                </tr>
              @if ($order->coupon!==null)
                  
                <tr>
                    <th>Coupon({{ $order->coupon }})</th>
                    <td>{{ $order->coupon_value }}</td>
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
       <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-body">

            <table class="table-responsive table">
                <tr>
                    <th> Name</th>
                    <td>{{ $shipping->name }}</td>
                </tr>
                <tr>
                    <th> Email</th>
                    <td>{{ $shipping->email }}</td>
                </tr>
                <tr>
                    <th> Phone</th>
                    <td>{{ $shipping->phone }}</td>
                </tr>
                <tr>
                    <th> State</th>
                    <td>{{ $shipping->state }}</td>
                </tr>
             
                <tr>
                    <th>Address</th>
                    <td>{{ $shipping->city }}</td>
                </tr>
              
                <tr>
                    <th>Zip Code</th>
                    <td>{{ $shipping->zip }}</td>
                </tr>
             
  
            </table>
        </div>
        </div>
    </div>
   </div>
   <div class="card mt-3 shadow-sm px-4 py-2 maxwidth " >
    @php
    $orderId=$order->order_id;
      $website=DB::table('websites')->first();
      $ship=DB::table('shippings')->where('order_id',$orderId)->first();
      $bill=DB::table('billings')->where('order_id',$orderId)->first();
      $order=DB::table('orders')->where('order_id',$orderId)->first();
      $product=DB::table('order_details')->join('products','products.id','order_details.product_id')->select('products.name','products.image','order_details.*','products.slug','products.id as pid')->where('order_id',$orderId)->get();
   
  @endphp
       <h3>Product Details</h3>
       <table  class="table table-responsive" >
        <thead>
            <tr>
                <th>Sl. <br> NO</th>

                <th>Description</th>
                <th>Unit <br>
                    Price</th>
                <th> Qty</th>
                <th> Net <br>
                    Amount</th>
                <th> Tax <br>
                    Rate</th>
                <th> CGST
                    </th>
                   
                <th> SGST 
                     </th>
                <th>Total <br>
                    Amount </th>
                    <td>
                        Status
                    </td>
                    <td>
                        Action
                    </td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalgst=0;
                $nettotal=0;
                $grandtotal=0;

            @endphp
            @foreach ($product as $item)     
            @php
            $total=$item->qty*$item->price;
            $gst_amount=($total*$item->gst)/100;
            $net=$total-$gst_amount;
            $totalgst+=$gst_amount;
            $nettotal+=$net;
            $grandtotal+=$total;


        @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
              
                <td>
                    <a href="{{ route('product.detail',['id'=>$item->pid,'slug'=>$item->slug]) }}">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" width="70" height="70">

                    </a>
                    <p class="py-0 my-0">
                        {{ $item->name }}
                    </p>
                    @if ($item->color!=null)
                    <div class="py-0 my-0 " style="display:flex;justify-content:start;align-items:center ">
                        Color: <div style="width:30px;height:15px;background:{{ $item->color }};margin-left:2px;"></div>
                    </div>
                    @endif

                    @if ($item->size!=null)
                    <p class="py-0 my-0">
                        Size: {{ $item->size }}
                    </p>
                    @endif
                    <p class="py-0 my-0">
                        HSN: {{ $item->hsn }}
                    </p>
                   </td>
                
                <td>{{ __getPriceunit() .$item->price }}</td>
                <td>{{ $item->qty }}</td>
                <td>
                  
                    {{ __getPriceunit(). $net }}
                
                </td>
                <td>{{ $item->gst }} %</td>
                <td>
                    @if (strtolower($bill->state)=='harayana' &&strtolower(DB::table('users')->where('id',$item->id)->value('state'))=='harayana' )
                    {{ $item->gst/2 }} 
                    @else
                    {{ $item->gst }}

                @endif
                %
                </td>
                <td>
                    @if (strtolower($bill->state)=='harayana' &&strtolower(DB::table('users')->where('id',$item->id)->value('state'))=='harayana' )
                    {{ $item->gst/2 }} %
                    @endif
                </td>
                <td>{{ __getPriceunit().$total}}</td>
                <td>
                    @if ($order->status==4)
                    <small >Order  cancelled <br> by You</small>
                        
                    @else   

                    @if ($item->status==4)
                    <small >Order  cancelled <br> by Seller</small>
                    <br>
                    @endif
                    @if ($item->status==0)
                    <span class="badge text-white bg-danger">
                         In review                  
                    </span>
                    @endif
                            
                    @if ($item->status==1)
                    <span class="badge text-white bg-primary">
                                   Proccessing            
                    </span>
                    @endif
                    @if ($item->status==2)
                    <span class="badge text-white bg-info">
                          Shipping                     
                    </span>
                    @endif @if ($item->status==3)
                    <span class="badge text-white bg-success">
                           Delivery                   
                    </span>
                    @endif
                     @if ($item->status==4)
                    <span class="badge text-white bg-danger">
                           Cancel                    
                    </span>
                    @endif
                    @if ($item->status==5)
                    <span class="badge text-white bg-warning">
                           Refund request sent                    
                    </span>
                    @endif

                    @if ($item->status==6)
                    <span class="badge text-white bg-info">
                           Refunded                    
                    </span>
                    @endif
                    @endif

                        </td>
                <td>
                    @if ($item->status==3)
                 <!-- Button trigger modal -->
                <button type="button" class="btn text-white custom-bg-secondary btn-sm refund_btn" data-bs-toggle="modal" data-bs-target="#refund" data-text="{{ $item->vendor_order_id }}">
                    Refund
                </button>
                    @endif
                   
                </td>
                        
            </tr>
            @endforeach

        
          
        </tbody>

    </table>
   </div>
</div>


  
  <!-- Modal -->
  <div class="modal fade" id="refund" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Refund Reason</h5>
          <a  class="close" data-bs-dismiss="modal" aria-label="Close" href="">
            <div class="fas fa-times fa-2x text-dark" ></div>
          </a>
        </div>

        <div class="modal-body">
          <form action="{{ route('order.refund') }}" method="POST">
            @csrf
            <input type="hidden" name="vendor_order_id" id="vendor_order_id">
            <input type="hidden" name="order_id" value="{{ $order->order_id }}">
            <textarea name="refund_reason" id="" class="form-control"></textarea>
            <input type="submit" class="btn btn-sm custom-bg-secondary form-control mt-2 text-white btn-block d-block " value="Refund" >
        </form>
        </div>
        
      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script>
    $('.refund_btn').click(function(){
        $val=$(this).data('text');
        $('#vendor_order_id').val($val);
    })

    
</script>

<script>
    function openWin()
{
    order_id={{ $order->order_id }}
    $.ajax({
        url:'{{ url('print-invoice') }}/'+order_id,
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
 
}
</script>
@endpush