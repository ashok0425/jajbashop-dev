@extends('admin.master')
@section('main-content')
<style>

    .image-preview1,.image-preview2,.image-preview3{
        display: none;
    }
    h5{
        font-weight: 800;
        margin-top: .4rem;
        font-size: 1.3rem;
    }
</style>
@php
    define('PAGE','kyc')
@endphp
<div class="container-fluid p-0 ">
    @if(!isset($kyc))
    <div class="card">
        <div class="card-body">
            <h4 class="text-danger">KYC not updated</h4>
        </div>
    </div>
        @else
<div class="card">
    <h3>KYC Detail</h3>
    <div class="card-body py-3 px-5">
        <form action="{{route('admin.kyc.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
    <div class="row">

<input type="hidden" value="{{$kyc->id}}" name="id">

        <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">Account Holder Name</label>
                <input type="text" class="form-control" name="name" value="@if(isset($kyc)){{$kyc->name}}@endif">
            </div>
                   </div>

                    <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">Bank Name</label>
                <input type="text" class="form-control" name="Bank_name" value="@if(isset($kyc)){{$kyc->Bank_name}}@endif">
            </div>
                    </div>

                    <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">Account Number</label>
                <input type="text" class="form-control" name="account_no" value="@if(isset($kyc)){{$kyc->account_no}}@endif">
            </div>
                    </div>

                    <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">IFSC</label>
                <input type="text" class="form-control" name="ifsc" value="@if(isset($kyc)){{$kyc->ifsc}}@endif">
            </div>
                    </div>

                    <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">Adhar Card No</label>
                <input type="text" class="form-control" name="adhar_card_no" value="@if(isset($kyc)){{$kyc->adhar_card_no}}@endif">
            </div>
                    </div>

                    <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">PAN No</label>
                <input type="text" class="form-control" name="pan_no" value="@if(isset($kyc)){{$kyc->pan_no}}@endif">
            </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="">Phone No</label>
                            <input type="text" class="form-control" name="phone" value="@if(isset($kyc)){{$kyc->phone}}@endif">
                        </div>
                                </div>
                    <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">Google Pay Id</label>
                <input type="text" class="form-control" name="google_pay_id" value="@if(isset($kyc)){{$kyc->google_pay_id}}@endif">
            </div>
      </div>

                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="">Phone Pay Id</label>
                            <input type="text" class="form-control" name="phone_pay_id" value="@if(isset($kyc)){{$kyc->phone_pay_id}}@endif">
                        </div>
                                </div>

                    <div class="col-md-3 mt-2">
                        <div class="form-group">
                            @if (isset($kyc->adhar_back))

                            <img src="@if(isset($kyc)){{asset($kyc->adhar_back)}}@endif" width="100" height="100" class=" image">
                            @endif
                            <img src=""  width="100" height="100" class="image-preview ">
                            <div class="image-input">
                                <input type="file" accept="image/*" id="imageInput" name="adhar_back">
                                <label for="imageInput" class="image-button"><i class="far fa-image"></i> Choose File </label>
                                <h5>Adhar Card Back</h5>

                              </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                        <div class="form-group">
                            @if (isset($kyc->adhar_front))

                            <img src="@if(isset($kyc)){{asset($kyc->adhar_front)}}@endif" width="100" height="100" class="image1">
                            @endif
                            <img src=""  width="100" height="100" class="image-preview1 ">
                            <div class="image-input">
                                <input type="file" accept="image/*" id="imageInput1" name="adhar_front">
                                <label for="imageInput1" class="image-button"><i class="far fa-image"></i> Choose File </label>
                                <h5>Adhar Card Front</h5>


                              </div>
                        </div>
                    </div>

                    <div class="col-md-3 mt-2">
                        <div class="form-group">
                            @if (isset($kyc->pancopy))

                            <img src="@if(isset($kyc)){{asset($kyc->pancopy)}}@endif" width="100" height="100" class=" image2">
                            @endif
                            <img src=""  width="100" height="100" class="image-preview2">
                            <div class="image-input">
                                <input type="file" accept="image/*" id="imageInput2" name="pancopy">
                                <label for="imageInput2" class="image-button"><i class="far fa-image"></i> Choose File </label>

                                <h5>Pan Copy</h5>

                              </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-2">
                        <div class="form-group">
                            @if (isset($kyc->bankproof))

                            <img src="@if(isset($kyc)){{asset($kyc->bankproof)}}@endif" width="100" height="100" class=" image3">
                            @endif

                            <img src=""  width="100" height="100" class="image-preview3">
                            <div class="image-input">
                                <input type="file" accept="image/*" id="imageInput3" name="bankproof">
                                <label for="imageInput3" class="image-button"><i class="far fa-image"></i> Choose File </label>

                                <h5>Bank Proof</h5>

                              </div>
                        </div>
                    </div>

<div class="col-md-12 mt-4">
    <label >Change Status</label>
    <select name="status" id="" class="form-control">
        <option value="0" @if ($kyc->status==0)
            selected
        @endif>Pending</option>
        <option value="2"  @if ($kyc->status==2)
            selected
        @endif>Approve</option>


        <option value="1"  @if ($kyc->status==1)
            selected
        @endif>Reject</option>
    </select>
    <br>
    <input type="submit" value="save" class="form-control">
</div>
</div>
</form>
    </div>
</div>
@endif

</div>
<a href="{{route('admin.kyc.pending')}}" class="btn btn-info">Back</a>

@endsection
@push('scripts')
<script>
    // Add the following code if you want the name of the file appear on select
    $('#imageInput1').on('change', function() {
$input = $(this);
if($input.val().length > 0) {
fileReader = new FileReader();
fileReader.onload = function (data) {
$('.image1').css('display','none')
$('.image-preview1').attr('src', data.target.result);
}
fileReader.readAsDataURL($input.prop('files')[0]);
//   $('.image-button').css('display', 'none');
$('.image-preview1').css('display', 'block');
$('.change-image1').css('display', 'block');
}
});
</script>


<script>
    // Add the following code if you want the name of the file appear on select
    $('#imageInput2').on('change', function() {
$input = $(this);
if($input.val().length > 0) {
fileReader = new FileReader();
fileReader.onload = function (data) {
$('.image2').css('display','none')
$('.image-preview2').attr('src', data.target.result);
}
fileReader.readAsDataURL($input.prop('files')[0]);
//   $('.image-button').css('display', 'none');
$('.image-preview2').css('display', 'block');
$('.change-image2').css('display', 'block');
}
});
</script>

<script>
    // Add the following code if you want the name of the file appear on select
    $('#imageInput3').on('change', function() {
$input = $(this);
if($input.val().length > 0) {
fileReader = new FileReader();
fileReader.onload = function (data) {
$('.image3').css('display','none')
$('.image-preview3').attr('src', data.target.result);
}
fileReader.readAsDataURL($input.prop('files')[0]);
//   $('.image-button').css('display', 'none');
$('.image-preview3').css('display', 'block');
$('.change-image3').css('display', 'block');
}
});
</script>
@endpush
