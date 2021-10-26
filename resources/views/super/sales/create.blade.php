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

@extends('super.master')

<!-- page content -->
@section('main-content')
<div class="response"></div>

<div class="row">
    <div class="col-md-6">
        <div class="card">

            <x-errormsg/>
                <h3>Make Quick Sales
                </h3>
            <div class="card-body">
                <form id="btnSave" action="{{route('super.sale.store')}}" method="GET">
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
                        <label for="price">Price per/pices*</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="price" required>
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

    <div class="col-md-6">
        <div class="card">

                <h3>Quick Sales Billing
                </h3>
                <div class="clearfix"></div>
            <div class="card-body">

                <div id="saleslist">

                </div>
                <a   class="btn btn-danger form-control my-2" onclick="return print()"><i class="fa fa-print"></i> Print Bill</a>

                <button class="btn btn-info form-control" data-toggle="modal" data-target="#checkout-modal"><i class="fa fa-download " ></i> Make Sale & Download invoice</button>

        </div>
    </div>
</div>
</div>
    <!-- /page content -->


    {{-- modal payment  --}}

  <!-- Modal -->
  <div class="modal fade" id="checkout-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <h3>BILL TO</h3>

        <div class="modal-body">
        <form action="{{route('super.sale.checkout')}}" method='POST'>
            @csrf
        <input type="email" name="email" required  class="form-control my-2" placeholder="Email Address">
        <input type="number" name="phone" required  class="form-control my-2" placeholder="Phone number">
        <div class="form-group mt-3 d-flex justify-content-around">
            <h4>Payment Mode</h4>
            <label class="d-flex align-items-center"><input type="radio" name="payment_mode" value="cash">&nbsp;&nbsp; Cash</label>
            <label class="d-flex align-items-center"><input type="radio" name="payment_mode" value="account">&nbsp;&nbsp; Account Fund</label>

        </div>
        <div class="modal-footer">
            <a  class="btn btn-secondary" data-dismiss="modal">Close</a>

            <button  class="btn btn-info">Checkout</button>

          </div>
        </form>

        </div>

      </div>
    </div>
  </div>
@endsection
@push('scripts')
<script src="{{asset('admin/fstdropdown.js')}}"></script>

    <script >
// fastdropdown

        $(document).ready(function () {
            $('.product_id').on('change', function (e) {
                e.preventDefault()
                var pid = $(this).val();
                var path = "{{url('super/getproductdata')}}/"+pid;
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
                    }
                });
            });
        });
        readsales();

        function readsales() {
            $.ajax({
                type: 'get',
                url: "{{url('super/sales/list')}}",
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
                url: "{{url('super/sales/delete')}}/"+id,
                dataType: 'json',
                success: function (data) {
                    readsales();
                    var m = "<div class='alert alert-success py-2 px-5'>" + data + "</div>";
                    $('.response').html(m);

                }
            })
        })

        // function printorder() {
        //         $.ajax({
        //             url: "{{url('sales-allpdf')}}",
        //             type: 'get',
        //             dataType: 'html',
        //             success:function(data) {
        //                 var mywindow = window.open('', 'Sabaiko Live Bakery', 'height=400,width=600');
        //                 mywindow.document.write('<html><head><title></title>');
        //                 mywindow.document.write('</head><body>');
        //                 mywindow.document.write(data);
        //                 mywindow.document.write('</body></html>');
        //                 mywindow.document.close();
        //                 mywindow.focus();
        //                 mywindow.print();
        //                 mywindow.close();

        //             }
        //         });
        // }

    </script>
@endpush
