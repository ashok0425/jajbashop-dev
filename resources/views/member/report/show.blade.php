@php
    define('PAGE','report')
@endphp
@extends('member.master')
@section('main-content')

<style>
    th,td{
        padding-left: 1rem;
        border:1px solid gray;
    }
</style>


@php
    $order=DB::table('orders')->where('id',$id)->first();
if($order->seller==4){
    $seller=DB::table('websites')->first();
     $seller->name='Jajbashop';
}elseif($order->seller==3){
    $seller=DB::table('supers')->where('id',$order->seller_id)->first();

}elseif($order->seller==2){
    $seller=DB::table('distributors')->where('id',$order->seller_id)->first();

}else{

}

@endphp
<div class="container mt-5">
   <div class="row">
       <div class="d-flex justify-content-between mb-3">
        <h4>Invoice Detail of order ID {{ $orderId }}</h4>
   <div class='d-flex'>
    <a href="{{route('super.report.print',['id'=>$id,'orderId'=>$orderId])}}" class="btn btn-danger mr-2"><i class="fas fa-print"></i>Print</a>
<a href="{{ route('super.buy.report') }}" class="btn btn-info text-white">Back</a>
   </div>
       </div>


       <div class="col-md-6">
          <h6>SELLER DETAIL</h6>
           <div class="card shadow">
            <div class="card-body">
                <table class="table">
                   <tr>
                       <th>Name</th>
                       <td>{{ $seller->name }}</td>
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
       </div>
       <div class="col-md-6">
           <h6>BUYER DETAIL</h6>
        <div class="card shadow">
         <div class="card-body">
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
                    <th>Pin Code</th>
                    <td>{{ $ship->pincode }}</td>
                </tr>
             
             
            </table>
        </div>
        </div>
    </div>
   </div>
   <div class="card mt-3 shadow">
       <h3>Product Details</h3>
       <table class="table table-responsive table-striped">
<thead>
    <th>Image</th>
    <th>Name</th>
    <th>Qty</th>
    <th>Price({{ __getPriceunit() }})</th>
    {{-- <th>GST(%)</th> --}}

    <th>BV</th>
</thead>
<tbody>
    @foreach ($product as $item)
    <tr>
    <td>
       <img src=" {{ __getimagePath($item->image) }}" alt="Product image" class="img-fluid" width="80">

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
    {{-- <td>{{ $item->gst }}</td> --}}

   <td>
        <p>{{ $item->bv*$item->qty }}</p>

        {{ $item->bv }}/Each
    </td>
</tr>
    @endforeach
   
</tbody>
       </table>
   </div>
 
</div>
@endsection