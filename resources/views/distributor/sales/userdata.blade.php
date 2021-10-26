<hr>


@if ($user)
    <div class="row py-2">

        
           <div class="col-md-3 font-weight-bold  text-info">
               Name:{{ $user->name }}
        </div>

               <div class="col-md-3 font-weight-bold text-info"  >
                   Phone:{{ $user->phone }}
               </div>
          
           
           <div class="col-md-3  font-weight-bold text-info">
               Address:{{ $user->address }}
           </div>
           <div class="col-md-3 text-info">
            <img src="{{ asset($user->profile_photo_path) }}" alt="" width="80" height="80">
           </div>
</div>

@else   
<div class="col-md- 12 font-weight-bold">
    <h4 class="text-danger pt-2 text-center">NO user found</h4>
</div>

@endif
<hr>
