<h5 class="custom-fw-700 border-bottom  custom-bg-secondary text-white py-1 py-md-3 px-md-4 px-1">Update Password</h5>

<div class="py-2">
    <form action="{{ route('profile.password') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="row">
        
      <div class="col-md-8 pb-2 pt-2 offset-md-2">
       <div class="form-group">
          <label class="custom-fs-16 custom-fw-500">Current Passwprd</label>
          <input type="password" name="currentpassword" required class="form-control">
       </div>
      </div>

      <div class="col-md-8 pb-2 pt-2 offset-md-2">
        <div class="form-group">
           <label class="custom-fs-16 custom-fw-500">New Passwprd</label>
           <input type="password" name="newpassword" required class="form-control">
        </div>
       </div>

       <div class="col-md-8 pb-2 pt-2 offset-md-2">
        <div class="form-group">
           <label class="custom-fs-16 custom-fw-500">Confirm Passwprd</label>
           <input type="password" name="confirmpassword" required class="form-control">
        </div>
       </div>
   
       <div class="col-12 text-right col-md-8 offset-2">
           <button  name="" value="update" class="btn custom-bg-orange text-white d-block">update</button>
       </div>
    </div>
    </form>
</div>