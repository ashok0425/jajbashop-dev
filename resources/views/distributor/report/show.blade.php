@php
    define('PAGE','report')
@endphp
@extends('distributor.master')
@section('main-content')

<style>
    th,td{
        padding-left: 1rem;
        border:1px solid gray;
    }
</style>


@php
    $order=DB::table('orders')->where('id',$id)->first();
    
if($order->seller==3){
    $seller=DB::table('supers')->where('id',$order->seller_id)->first();
    $seller->copy_right=$seller->name;
}else{
    $seller=DB::table('distributors')->where('id',$order->seller_id)->first();
    $seller->copy_right=$seller->name;
}

@endphp
<div class="container mt-5">
   <div class="row">
       <div class="d-flex justify-content-between mb-3">
        <h4>Invoice Detail of order ID {{ $orderId }}</h4>
   <div class='d-flex'>
    <button class="btn btn-danger mr-2 d_in_win openWin" data-id="{{ $id }}"><i class="fas fa-print"></i> Print</button>

    <a href="{{route('distributor.report.print',['id'=>$id,'orderId'=>$orderId])}}" class="btn btn-danger mr-2"><i class="fas fa-download"></i>Download</a>
<a href="{{ route('distributor.buy.report') }}" class="btn btn-info text-white">Back</a>
   </div>
       </div>


       <div class="col-md-6">
          <h6>SELLER DETAIL</h6>
           <div class="card shadow">

               <table class="table">
                   <tr>
                       <th>Name</th>
                       <td>{{ $seller->copy_right }}</td>
                   </tr>
                    <tr>
                       <th>Email</th>
                       <td>{{ $seller->email }}</td>
                   </tr>
                    <tr>
                       <th>Phone</th>
                       <td>{{ $seller->phone }}</td>
                   </tr>
             <tr>
                       <th>OrderID</th>
                       <td>{{ $orderId }}</td>
                   </tr>
                   <tr>
                    <th>Comission ({{__getPriceunit()}})</th>
                    <td>{{ $order->comission }}</td>
                </tr>
                 <tr>
                    <th> Total ({{__getPriceunit()}})</th>
                   
                    <td>{{ $order->total }}</td>
                </tr>

                 <tr>
                    <th> Total BV</th>
                   
                    <td>{{ $order->bv }}</td>
                </tr>
               </table>

           </div>
       </div>
       <div class="col-md-6">
           <h6>BUYER DETAIL</h6>
        <div class="card shadow">

            <table class="table">
                <tr>
                    <th> Name</th>
                    <td>{{ $ship->name }}</td>
                </tr>
                <tr>
                    <th> Email</th>
                    <td>{{ $ship->email }}</td>
                </tr>
                <tr>
                    <th> Phone</th>
                    <td>{{ $ship->phone }}</td>
                </tr>
                <tr>
                    <th> State</th>
                    <td>{{ $ship->state }}</td>
                </tr>
             
                <tr>
                    <th>District</th>
                    <td>{{ $ship->district }}</td>
                </tr>
              <tr>
                    <th>City</th>
                    <td>{{ $ship->city }}</td>
                </tr>
                <tr>
                    <th>Pin Code</th>
                    <td>{{ $ship->pincode }}</td>
                </tr>
             
             
            </table>

        </div>
    </div>
   </div>
   <div class="card mt-3 shadow">
       <h3>Product Details</h3>
       <div class="card-body table-responsive">
       <table class="table table-responsive table-striped">
<thead>
    <th>Image</th>
    <th>Name</th>
    <th>Qty</th>
    <th>Price({{ __getPriceunit() }})</th>
    <th>GST(%)</th>

    <th>BV</th>
    <th>Comission</th>

</thead>
<tbody>
    @foreach ($product as $item)
    <tr>
    <td>
        {{ __getimagePath($item->image) }}
       <img src="{{ __getimagePath($item->image) }}" alt="Product image" class="img-fluid" width="80">

    </td>
  <td>
        {{ $item->name }}
    </td>
    <td>
        {{ $item->qty }}
    </td>
    
    <td>
        <p>
        {{ $item->price*$item->qty }}</p>

        {{ $item->price }}/Each
    </td>
    <td>{{ $item->gst }}</td>

   <td>
        <p>{{ $item->bv*$item->qty }}</p>

        {{ $item->bv }}/Each
    </td>

    <td>
        <p>{{ $item->comission*$item->qty }}</p>

        {{ $item->comission }}/Each
    </td>
</tr>
    @endforeach
   
</tbody>
       </table>
    </div>
   </div>
 
</div>

@endsection

@push('scripts')
<script>
    $('.openWin').click(function openWin()
 {
     id=$(this).data('id')
     $.ajax({
         url:'{{ url('distributor/report/print') }}/'+id,
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
