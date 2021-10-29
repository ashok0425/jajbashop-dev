<h5 class="custom-fw-700 border-bottom  custom-bg-secondary text-white py-1 py-md-3 px-md-4 px-1">Update profile</h5>

<div class="py-2">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row">
        
      <div class="col-md-6 pb-2 pt-2">
       <div class="form-group">
          <label class="custom-fs-16 custom-fw-500">Name</label>
          <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">
       </div>
      </div>

      <div class="col-md-6 pb-2 pt-2">
        <div class="form-group">
           <label class="custom-fs-16 custom-fw-500">Email</label>
           <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">
        </div>
       </div>

       <div class="col-md-6 pb-2 pt-2">
        <div class="form-group">
           <label class="custom-fs-16 custom-fw-500">Phone</label>
           <input type="number" name="phone" value="{{ Auth::user()->phone }}" class="form-control">
        </div>
       </div>

       <div class="col-md-6 pb-2 pt-2">
        <div class="form-group">
           <label class="custom-fs-16 custom-fw-500">Image</label>
           <div class="image-input">
            <input type="file" accept="image/*" id="imageInput" name="file" class="d-none">
            <label for="imageInput" class="image-button"><i class="far fa-image"></i> Upload Profile Picture </label>
            
           
          </div>
        <img src=""  width="100" height="100" class="image-preview rounded-circle">

        </div>
       </div>
       <div class="col-12 text-right">
           <button type="submit" name="" value="update" class="btn custom-bg-orange text-white btn-block">update</button>
       </div>
    </div>
    </form>

   
    <form action="{{ route('shipping.update') }}" method="POST">
        @csrf
    <div class="row">
       {{-- billing address  --}}
<div class="col-12 mt-1">
<h5 class="custom-fw-700 border-bottom  custom-bg-secondary text-white py-1 py-md-3 px-md-4 px-1">Update Shipping Address</h5>
</div>

<div class="col-md-6 pb-2 pt-2">
    <div class="form-group">
       <label class="custom-fs-16 custom-fw-500">Country</label>
       <input type="text" name="country" id="" class="form-control" value="@if (isset($ship))
           {{ $ship->country }}
       @endif">
    </div>
   </div>

   <div class="col-md-6 pb-2 pt-2">
     <div class="form-group">
        <label class="custom-fs-16 custom-fw-500">State</label>
        <input type="text" name="state" id="" class="form-control" value="@if (isset($ship))
           {{ $ship->state }}
       @endif">
     </div>
    </div>

    <div class="col-md-6 pb-2 pt-2">
     <div class="form-group">
        <label class="custom-fs-16 custom-fw-500">District</label>
        <input type="text" name="district" id="" class="form-control" value="@if (isset($ship))
           {{ $ship->district }}
       @endif">
     </div>
    </div>

    <div class="col-md-6 pb-2 pt-2">
     <div class="form-group">
        <label class="custom-fs-16 custom-fw-500">City</label>
        <input type="text" name="city" id="" class="form-control" value="@if (isset($ship))
           {{ $ship->city }}
       @endif">
     </div>
    </div>
    <div class="col-md-6 pb-2 pt-2">
        <div class="form-group">
           <label class="custom-fs-16 custom-fw-500">Address</label>
           <input type="text" name="address" id="" class="form-control" value="@if (isset($ship))
           {{ $ship->address }}
       @endif">
        </div>
       </div>

       <div class="col-md-6 pb-2 pt-2">
        <div class="form-group">
           <label class="custom-fs-16 custom-fw-500">Pincode</label>
           <input type="text" name="pincode" id="" class="form-control" value="@if (isset($ship))
           {{ $ship->pincode }}
       @endif">
        </div>
       </div>
       <div class="col-12 text-right">
        <button type="submit" name="" value="update" class="btn custom-bg-orange text-white btn-block">update</button>
    </div>
    </div>
</form>
</div>
<script>
        // {{-- custom input fielsd file  --}}
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
  $('.image-preview').css('display', 'block');
}
});
</script>