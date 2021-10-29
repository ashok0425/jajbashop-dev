

@extends('frontend.master')
<style>
    .form-control{
        border: 0!important;
        border-bottom: 1px solid gray!important;
        border-radius:0!important;
    }
label{
    font-weight: 600;
}
.form-group{
    margin-bottom: 1rem!important;
}
</style>
@section('header')
<section class="section-pagetop bg_gray ">
    <div class="container">
          <h2 class="border-bottom mb-3 pb-2 ">Contact Us</h2>
    </div> <!-- container //  -->
    </section>
@endsection
@section('content')

      <section class="container my-5">
        <!--Contact heading-->
        <div class="row">

           <!--Grid column-->
           <div class="col-sm-12 mb-4 col-md-6 offset-md-3">
              <!--Form with header-->
              <div class="card border-info rounded-0">
                 <div class="card-header p-0">
                    <div class="custom-bg-primary text-white text-center py-2">
                       <h3><i class="fa fa-envelope"></i> Leave us a message here!</h3>

                    </div>
                 </div>
                 <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                 <div class="card-body p-3">

                       <div class="form-group">
                       <label> Your Name </label>
                       <div class="input-group">
                          <input value="" type="text" name="name" class="form-control" id="inlineFormInputGroupUsername" placeholder="Full Name">
                       </div>
                     </div>
                       <div class="form-group">
                          <label>Your Email Address</label>
                          <div class="input-group mb-2 mb-sm-0">
                             <input type="email" value="" name="email" class="form-control" id="inlineFormInputGroupUsername" placeholder="Email Address">
                          </div>
                       </div>
                       <div class="form-group">
                          <label>Your Contact Number</label>
                          <div class="input-group mb-2 mb-sm-0">
                             <input type="number" name="phone" class="form-control" id="inlineFormInputGroupUsername" placeholder="Contact Number">
                          </div>
                       </div>
                       <div class="form-group">
                          <label>Your Message</label>
                          <div class="input-group mb-2 mb-sm-0">
                             <textarea type="text" class="form-control" name="msg"></textarea>
                          </div>
                       </div>
                       <div class="text-center">
                          <input type="submit" name="submit" value="submit" class="btn text-white custom-bg-primary btn-block rounded-0 py-2">
                       </div>

                      </div>
                    </form>

                 </div>
              </div>
           <!--Grid column-->

           
             </div>
     </section>
@endsection
