<style>
    .image-input {
	text-aling: center;
}

.image-input input {
	display: none;
}

.image-input label {
	display: block;
	color: #FFF;
	background: #000;
	padding: .3rem .6rem;
	font-size: 115%;
	cursor: pointer;
}

.image-input label i {
	font-size: 125%;
	margin-right: .3rem;
}

.image-input label:hover i {
	animation: shake .35s;
}

.image-input img {
	max-width: 175px;
	display: none;
}

.image-input span {
	display: none;
	text-align: center;
	cursor: pointer;
}
.image-preview1,.image-preview2,.image-preview3,.image-preview4,.image-preview5{
    max-height: 100px;
}
@keyframes shake {
	0% {
		transform: rotate(0deg);
	}

	25% {
		transform: rotate(10deg);
	}

	50% {
		transform: rotate(0deg);
	}

	75% {
		transform: rotate(-10deg);
	}

	100% {
		transform: rotate(0deg);
	}
}




section .section-title {
    text-align: center;
    margin-bottom: 50px;
    text-transform: uppercase;
}



#tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 4px solid !important;
    font-size: 16px;
    font-weight: bold;
}
#tabs .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    font-size: 16px;
}

label{
    font-size:14px!important;
    font-weight: 400!important;
}

</style>
<h5 class="custom-fw-700 border-bottom  custom-bg-secondary text-white py-1 py-md-3 px-md-4 px-1">Update KYC Detail</h5>
    <div class="card-body py-3 ">
       
        <form action="{{route('kyc.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
    <div class="row">



        <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">Account Holder Name</label>
                <input type="text" class="form-control" name="name" value="@if(isset($kyc)){{$kyc->name}}@endif" required>
            </div>
                   </div>

                    <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">Bank Name</label>
                <input type="text" class="form-control" name="Bank_name" value="@if(isset($kyc)){{$kyc->Bank_name}}@endif" required>
            </div>
                    </div>

                   
                     <div class="col-md-6">
                    <div class="form-group mt-2">
                            <label for=""> Account Number</label>
                               <input type="text" class="form-control " name="account_no" value="@if(isset($kyc)){{$kyc->account_no}}@endif" required>
                         </div>
                              </div>
        
                <div class="col-md-6">
                       <div class="form-group mt-2">
                          <label for=""> IFSC</label>
                        <input type="text" class="form-control" name="ifsc" value="@if(isset($kyc)){{$kyc->ifsc}}@endif" required>
                     </div>
                               </div>

                    <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="">Adhar Card No</label>
                <input type="text" class="form-control" name="adhar_card_no" value="@if(isset($kyc->adhar_card_no)){{$kyc->adhar_card_no}} @endif" required>
            </div>
                    </div>
          
            
                    <div class="col-md-6">
                        <div class="form-group mt-2">
                            <label for="">Contact No</label>
                            <input type="text" class="form-control" name="phone" value="@if(isset($kyc->phone)){{$kyc->phone}}  @endif" required>
                        </div>
                                </div>
                    <div class="col-12">
                        <hr>
                        <label  class="d-flex align-items-center">
                            <input type="checkbox" name="term" required> <strong class="text-success font_5" required>  &nbsp; &nbsp;I here by aggree that all above deatail are correct.</strong>
                        </label>
                    </div>
<div class="col-md-12 mt-4">

    <input type="submit" value="save" class="form-control custom-bg-secondary text-white   >


</div>
</div>
</form>
    </div>
</div>
</div>

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
    $('#imageInput').on('change', function() {
$input = $(this);
if($input.val().length > 0) {
fileReader = new FileReader();
fileReader.onload = function (data) {
$('.image').css('display','none')
$('.image-preview').attr('src', data.target.result);
}
fileReader.readAsDataURL($input.prop('files')[0]);
//   $('.image-button').css('display', 'none');
$('.image-preview').css('display', 'block');
$('.change-image').css('display', 'block');
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
