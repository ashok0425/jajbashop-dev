@php
    define('PAGE','sales')
@endphp
@push('style')
    {{-- searchable select  --}}
    <link rel="stylesheet" href="{{asset('admin/fstdropdown.css')}}">
    <style>
        th,td{
            font-size: 14px!important;
        }
    </style>
@endpush
@extends('distributor.master')


<!-- page content -->
@section('main-content')
<div class="response"></div>

    <div class="card py-3 px-3">
        <div class="row">
            <div class="col-md-6 offset-md-3">
<label>User ID/Phone number</label>

    <input type="text" name="userid" id="userid" class="form-control" autocomplete="off">
            </div>
         
           
<div class="col-md-12" id="userdata">

</div>
        </div>
    </div>
<div class="row">
    <div class="col-md-5">
        <div class="card">

            <x-errormsg/>
                <h3>Make Quick Sales
                </h3>
            <div class="card-body">
                <form id="btnSave" action="{{route('distributor.sale.store')}}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group my-2">
                        <label for="product_id">Choose Product</label>

                            <select class="fstdropdown-select product_id" id="product_id" name="product_id">
                                <option value="" >---select product--</option>
                                @foreach ($product as $item)
                                <option value="{{$item->id}}"> {{$item->name}}</option>
                                @endforeach
                            </select>



                    </div>
                    <div class="form-group my-2">
                        <label for="quantity">Stock Available</label>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock Available" disabled>

                    </div>
                    <div class="form-group my-2">
                        <label for="price">Price per/pcs*</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="price"  readonly>
                    </div>
                    <div class="form-group my-2">
                        <label for="sales_quantity">Sales Quantity</label>
                        <input type="number" min="1"  class="form-control" id="sales_quantity" name="sales_quantity" placeholder="Quantity" required>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="btnSave" class="btn btn-primary"> Make QuickSales </button>
                    </div>
                </form>
            </div>
        </div>
</div>

    <div class="col-md-7">
        <div class="card">

                <h3>Quick Sales Billing
                </h3>
                <div class="clearfix"></div>
            <div class="card-body">

                <div id="saleslist">

                </div>
                
                <form action="{{route('distributor.sale.checkout')}}" method='POST'>
                    @csrf
                    <div class="form-group mt-2 ">
                        <h4>Payment Mode</h4>
                        <label class="d-flex align-items-center">
                            <input type="radio" name="payment_mode" value="cash" required>&nbsp;&nbsp; Cash</label>
                        <label class="d-flex align-items-center"><input type="radio" name="payment_mode" value="account" required>&nbsp;&nbsp; Account Fund</label>
            
                    </div>
                <a   class="btn btn-danger form-control my-2" onclick="return print()" ><i class="fa fa-print"></i> Print Bill</a>

                    <input type="hidden" name="userid" id="user_id" required>
                <button class="btn btn-info form-control" ><i class="fa fa-download " ></i> Make Sale & Download invoice</button>
    </form>


        </div>
    </div>
</div>
</div>
    <!-- /page content -->



  
@endsection
@push('scripts')
<script src="{{asset('admin/fstdropdown.js')}}"></script>

    <script >
// fastdropdown

        $(document).ready(function () {
            $('.product_id').on('change', function (e) {
                e.preventDefault()
                var pid = $(this).val();
                var path = "{{url('distributor/sales/getproductdata')}}/"+pid;
                $.ajax({
                    url: path,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {                        
                        $('#quantity').empty();
                        $('#stock').val(data.qty);
                        $('#price').val(data.price);
                        $('#sales_quantity').attr({max: data.qty});

                    }
                });

            });

        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                }
            });
            $('#btnSave').on('submit', function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                var data = $(this).serialize();
                $.ajax({
                    url: url,
                    type: post,
                    data: data,
                    success: function (data) {
                        readsales()
                        document.getElementById("btnSave").reset();
                        $('product_id').val('');
                        var m = "<div class='alert alert-success py-2 px-5'>" + data + "</div>";
                    $('.response').html(m);
                    }
                });
            });
        });
        readsales();

        function readsales() {
            $.ajax({
                type: 'get',
                url: "{{url('distributor/sales/list')}}",
                dataType: 'html',
                success: function (data) {
                    $('#saleslist').html(data);
                }
            })
        }

        $(document).on('click','.delete-sales',function() {
            let id=$(this).data('id');
            $.ajax({
                type: 'get',
                url: "{{url('distributor/sales/delete')}}/"+id,
                dataType: 'json',
                success: function (data) {
                    readsales();
                    var m = "<div class='alert alert-success py-2 px-5'>" + data + "</div>";
                    $('.response').html(m);

                }
            })
        })


    </script>
    <script>
     
        function loaduserdata(data){
            $.ajax({
                url:'{{ url('distributor/loaduserdata')}}/'+data,
                dataType:'html',
                type:'GET',
                success:function($data){
                  $('#userdata').html($data)
                  $('#user_id').val(data)

                },
                
            });
        }


        $('#userid').keyup(function(){
            $('#userdata').html('')

            data=$(this).val()
            if(data.length>=5){
                loaduserdata(data)
            }else{
                $('#userdata').html("<div class='text-center text-danger mt-1'>No valid Disributor found</div>")

            }
        })

    </script>
@endpush
