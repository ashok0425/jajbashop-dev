
<style>
    th{
        font-size: 12px;
    }
    td{
        text-align: center;
    }
</style>
<h5 class="custom-fw-700 border-bottom  custom-bg-secondary text-white py-1 py-md-3 px-md-4 px-1">Order List</h5>

<div class="py-2">
    <table  class="table " id="myTable">
        <thead>
            <tr>
                <th>#</th>
    
                <th class="custom-fs-12 custom-fw-40 text-center">Order ID</th>
                <th class="custom-fs-12 custom-fw-40 text-center">Total <br> Price  </th>
                <th class="custom-fs-12 custom-fw-40 text-center">Delivery <br> Charge  </th>

                <th class="custom-fs-12 custom-fw-40 text-center">Payment <br> Method</th>
              
                <th class="custom-fs-12 custom-fw-40 text-center">Action</th>
    
    
                
            </tr>
        </thead>
        <tbody>
            
            @foreach ($order as $item)
                <tr> 
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->order_id}}</td>
                    <td>{{ __getPriceunit() }}{{$item->total}}</td>
                    <td>{{ __getPriceunit() }} {{$item->shipping_charge}}</td>

                    <td>{{$item->payment_type}}</td>
    
              
                   
                    <td>
                        <a href="{{ route('order.show',['id'=>$item->id,'orderId'=>$item->order_id]) }}" class="badge custom-bg-secondary text-white">view order</a>
                        <br>
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
          @if (count($order)>=4)
          <center><a href="{{ route('order') }}" class="btn custom-bg-secondary text-white btn-sm">View All</a></center>
          @endif

          
              
{{-- // datatables iniziing --}}
<script>
    if(window.innerWidth<=700){
        var table = $('#myTable').DataTable({
                "scrollX": true,

			});
     
    }else{

			var table = $('#myTable').DataTable({
                // "scrollX": true,
			
     
			});
      
    }
	</script>


          
</div>

   