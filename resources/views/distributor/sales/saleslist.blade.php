<style>
    .dataTables_info{
        display: none!important;
    }
    .dataTables_paginate {
        display: none!important;
    }
</style>
<table id="myTables" width="100%" class="table  " >
    <thead>
    <tr>
        <th>S.N.</th>
        <th>Name</th>
        <th> Price</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Bv</th>

        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($sales as $pc)
        <tr>
            <th> {{$loop->iteration}}</th>
            <td>{{$pc->name}} </td>
            <td>{{$pc->price}} </td>

            <td> {{$pc->qty}}</td>
            <td>{{$pc->price*$pc->qty}} </td>
            <td>{{$pc->bv*$pc->qty}} </td>


            <td>
                    <a  class="btn btn-danger delete-sales "   data-id="{{$pc->id}}"><i class="fas fa-trash" ></i></a>
                </td>
        </tr>
    @endforeach
   
    </tbody>
</table>

      
            <?php 
            $total=0;
            $bv=0 ;
            ?>
                @if($sales)
                    @foreach($sales as $s)
                        @php
    
                        $total += $s->price*$s->qty;
                        $bv += $s->bv*$s->qty;

                        @endphp
                    @endforeach
                    <div class="d-flex justify-content-between ">
                        <h4 class="mt-2"> Total Amount :{{$total}}</h4>
                        <h4 class="mt-2">Total Bv  : {{$bv}}</h4>
                
                    </div>
                @endif
   
    



{{-- datatables iniziing --}}
<script>
        var table = $('#myTables').DataTable({
                "scrollX": true,

				select: true,
				
				dom: 'Bfrtip',
				buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                    columns: [ 0, 1, 2,3,4,5 ]
                }
                    },
                  
                
                    {
                        extend: 'pdf',
                        exportOptions: {
                    columns: [ 0, 1,2,3,4,5 ]
                }
                    },
                   
                ]
			});
     
   
	</script>