@extends('frontend.master')
@section('header')
<section class="card py-1 py-md-3">
    <div class="container">
          <h2 class="custom-fs-25 custom-fw-600">Order List</h2>
    </div> <!-- container //  -->
    </section>
@endsection
@section('content')
<div class="container my-5">
  
    <div class="card py-3 px-4 ">
        <table id="myTable" class="table " >
            <thead>
                <tr>
                    <th>#</th>

                    <th>Date</th>
                    <th>Order ID</th>
                    <th>Total <br> Price  </th>
                    <th>Total <br> Delivery  </th>
                    <th>Payment <br> Mode</th>
                    <th>Action</th>

  
                    
                </tr>
            </thead>
            <tbody>
                
                @foreach ($order as $item)
                    <tr> 
                        <td>{{$loop->iteration}}</td>
                        <td>{{carbon\carbon::parse($item->created_at)->format('d M Y')}}</td>
                        <td>{{$item->order_id}}</td>
                        <td>{{ __getPriceunit() }} {{$item->total}}</td>
                        <td>{{ __getPriceunit() }} {{$item->shipping_charge}}</td>

                        <td>{{$item->payment_type}}</td>

                       
                       
                    <td>
                        
                        <button   class="badge  text-white bg-danger invoice_print" data-text="{{ $item->order_id }}"><i class="fas fa-print" ></i> Print</button>
                        <a href="{{ route('order.show',['id'=>$item->id,'orderId'=>$item->order_id]) }}" class="badge custom-bg-secondary text-white">view order</a>
                            @if ($item->status==0)
                            <a href="{{ route('order.cancel',['id'=>$item->id,'orderId'=>$item->order_id]) }}" class="badge bg-danger text-white">Cancel Order</a>
                            @endif
                            @if ($item->status==4)
                            <small class="text-danger">Order  cancelled by you</small>
                            @endif
                    </td>
                                        
                    </tr>
                @endforeach
            </tbody>
              </table>
    </div>
</div>



@endsection

@push('scripts')


<script>
   $('.invoice_print').click(function()
{
    order_id=$(this).data('text');
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
 
})
</script>
@endpush