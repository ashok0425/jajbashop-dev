@php
    define('PAGE','super')
@endphp
@push('style')
    {{-- searchable select  --}}
    <link rel="stylesheet" href="{{asset('admin/fstdropdown.css')}}">
  
@endpush
@extends('admin.master')


<!-- page content -->
@section('main-content')
<div class="response"></div>

<div class="row">
    <div class="col-md-6">
        <div class="card">

            <x-errormsg/>
                <h3>Make Quick Purchase
                </h3>
            <div class="card-body">
                <form id="btnSave" action="{{route('admin.sale.store')}}" method="GET">
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
                        <label for="price">Price per/pcs*</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="price" required readonly>
                    </div>
                    <div class="form-group my-2">
                        <label for="sales_quantity">Purchase Quantity</label>
                        <input type="number" min="1" value="1" class="form-control" id="sales_quantity" name="sales_quantity" placeholder="Quantity" required>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" name="btnSave" class="btn btn-primary"> Make Quick Sale </button>
                    </div>
                </form>
            </div>
        </div>
</div>

    <div class="col-md-6">
        <div class="card">

                <h3>Quick Purchase Billing
                </h3>
                <div class="clearfix"></div>
            <div class="card-body">
       
                <div id="purchaselist">

                </div>

                <button class="btn btn-info form-control" data-toggle="modal" data-target="#checkout-modal"><i class="fa fa-download " ></i> Sale & send invoice</button>

        </div>
    </div>
</div>
</div>
    <!-- /page content -->


    {{-- modal payment  --}}
    {{-- fetching all super distributor --}}
@php
    $sd=DB::table('supers')->orderBy('id','desc')->get();
@endphp
  <!-- Modal -->
  <div class="modal fade" id="checkout-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <h3>Super Distributor Detail</h3>

        <div class="modal-body">
        <form action="{{route('admin.sale.checkout')}}" method='POST'>
            @csrf
            <input type="hidden" name="width" id="width">
          <div class="form-group">
              <label for="">Email Address</label>
              <input type="email" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label for="">Phone number</label>
            <input type="number" name="phone" class="form-control">
        </div>
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
                var path = "{{url('admin/sale/getproductdata')}}/"+pid;
                $.ajax({
                    url: path,
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {                        
                        $('#price').val(data.offer_price);

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
                url: "{{url('admin/sale/list')}}",
                dataType: 'html',
                success: function (data) {
                    $('#purchaselist').html(data);
                }
            })
        }

        $(document).on('click','.delete-sales',function() {
            let id=$(this).data('id');
            $.ajax({
                type: 'get',
                url: "{{url('admin/sale/delete')}}/"+id,
                dataType: 'json',
                success: function (data) {
                    readsales();
                    var m = "<div class='alert alert-success py-2 px-5'>" + data + "</div>";
                    $('.response').html(m);

                }
            })
        })

       let width=$(window).width();
        $('#width').val(width)
  
</script>
@endpush
  