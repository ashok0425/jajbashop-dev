<div class="data responsive">
    <table id="myTable" class="table table-responsive-sm " >
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">order Id</th>
                <th class="text-center">Vendor <br> order Id</th>
                <th class="text-center">Image</th>
                <th class="text-center"> Detail</th>
                <th class="text-center"> Price <br>(per qty)</th>

                <th class="text-center">Payment Type</th>
                <th class="text-center">Status</th>
                <th class="text-center">Change <br> status</th>

                <th class="text-center">Action</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($order as $item)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td class="text-center">{{$item->order_id}}</td>

                    <td class="text-center">{{$item->vendor_order_id}}</td>
                    <td class="text-center"><img src="{{asset($item->image)}}" alt="{{ $item->name }}" class="img-fluid" width="50" height="50"></td>
                    <td class="text-center">
                        <p class="py-0 my-0">
                            {{$item->name}}
                        </p>
                        @if ($item->color)
                        <p class="py-0 my-0 d-flex justify-content-center align-items-center">
                            Color: <span class="btn p-3 mx-1" style="background: {{ $item->color }}"></span>
                        </p> 
                        @endif
                       
                        @if ($item->size)
                        <p class="py-0 my-0">
                            Size: {{$item->size}}
                        </p> 
                        @endif
                    </td>
                    <td>
                        {{ __getPriceunit() }}{{ $item->price }}
                    </td>
                    <td class="text-center">{{$item->payment_type}}</td> 
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
                    <form action="{{ route('vendor.order.status')}}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $item->order_id }}">
                        <input type="hidden" name="vendor_order_id" value="{{ $item->vendor_order_id }}">
                        <input type="hidden" name="status_id" value="1">
                
                        <input type="submit" class="btn btn-sm bg-success " value="Accept">
                    </form>                         
                     <form action="{{ route('vendor.order.status')}}" method="POST">
                         @csrf
                         <input type="hidden" name="order_id" value="{{ $item->order_id }}">
                         <input type="hidden" name="vendor_order_id" value="{{ $item->vendor_order_id }}">
                         <input type="hidden" name="status_id" value="1">
                         <input type="submit" class="btn btn-sm bg-danger " value="Cancel">
                     </form>
                     @elseif($item->status==1)
                     <a href="#" data-order_id="{{ $item->order_id }}" data-vendor_order_id="{{ $item->vendor_order_id }}" class="badge bg-warning text-white call_for_pickup"  data-toggle="modal" data-target="#callforpickup" data-width="{{ $item->width }}" data-height="{{ $item->height }}" data-lenght="{{ $item->length }}">Call  Pickup</a>

                     @elseif($item->status==2||$item->status==3)

                      <a href="https://pickrr.com/order/generate-user-order-manifest-png/{{ __gettoken() }}/{{ $item->logistic_id }}/" class="btn btn-success btn-sm">Label</a>
                     @endif

                 

                </td>
                <td class="text-center">
                    <div class="btn-group">

                                <a href="{{ route('admin.order.show',['order_id'=>$item->order_id,'vendor_order_id'=>$item->vendor_order_id])}}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="#" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $item->vendor_order_id }}" class="calc btn btn-primary btn-sm">
                                    <i class="fas fa-calculator "></i></a>
                                
                                <a  data-id="{{ $item->order_id }}" class="invoice_print btn btn-danger btn-sm" data-order_id="{{ $item->order_id }}" data-vendor_order_id="{{ $item->vendor_order_id }}">
                                    <i class="fas fa-print "></i>
                                </a>
                    </div>
                            </td>
                </tr>
            @endforeach
        </tbody>
          </table>
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
            <form action="{{ route('vendor.order.status') }}" method="POST" enctype="multipart/form-data">
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
{{-- datatables iniziing --}}
<script>
    if(window.innerWidth<=700){
        var table = $('#myTable').DataTable({
                "scrollX": true,

				select: true,
				dom: 'Blfrtip',
				lengthMenu: [
					[10, 25, 50, -1],
					['10 row', '25 row', '50 row', 'All Rows']
				],
				dom: 'Bfrtip',
				buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'colvis',
                 
                    },
                    'pageLength',
                ]
			});
     
    }else{

			var table = $('#myTable').DataTable({
                // "scrollX": true,
				select: true,
				dom: 'Blfrtip',
				lengthMenu: [
					[10, 25, 50, -1],
					['10 row', '25 row', '50 row', 'All Rows']
				],
				dom: 'Bfrtip',
        buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4, 5 ]
                }
                    },
                    {
                        extend: 'colvis',
                 
                    },
                    'pageLength',
                    
                ]
			});
      
    }
	</script>
