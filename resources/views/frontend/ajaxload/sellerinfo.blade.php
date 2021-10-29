<div class="p-4">
    <div class="row">
        
      <div class="col-md-8 pb-2 pt-2">
        <h4 class="custom-fw-800">Seller info</h4>
     
       <p class="my-0 py-0 mb-1">  Name: {{ $seller->display_name }}</p>
       <p class="my-0 py-0 mb-1">  State: {{ $seller->company_state }}</p>
       @if ($seller->fssai==null)
           
       @else   
       <p class="my-0 py-0 mb-1"> FASSAI License no. : {{ $seller->fssai }}</p>

       @endif


    
            <div class="row">
              {{-- Average rating  --}}
              <div class="col-5 border-right">
                <p class="custom-fw-700 pb-0 mb-0 custo-fs-40">Average Rating</p>
                <div class=" custom-text-orange custom-fw-900 py-3"><div class="fas fa-star fa-5x"></div></div>
                <div class="custom-fw-500"><span class="custom-bg-orange">{{ number_format($avg,1) }}</span> Based on {{count($rating) }} ratings</div>
              </div>
        
              {{-- rating progress bar  --}}
              <div class="col-7 ">
        
                <div class="row">
               <div class="col-3 px-0 mx-0">
                  5 Stars
               </div>
               <div class="col-8 px-0 mx-0 pt-1">
                  <div class="progress ">
                    <div class="progress-bar custom-bg-orange  " role="progressbar" style="width: {{ $avg5 }}%" aria-valuenow="{{ $avg5 }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
              </div>
            </div>
        
            <div class="row">
              <div class="col-3 px-0 mx-0">
                 4 Stars
              </div>
              <div class="col-8 px-0 mx-0 pt-1">
                 <div class="progress ">
                   <div class="progress-bar custom-bg-orange  " role="progressbar" style="width: {{ $avg4 }}%" aria-valuenow="{{ $avg4 }}" aria-valuemin="0" aria-valuemax="100"></div>
                 </div>
             
             </div>
           </div>
        
           <div class="row">
            <div class="col-3 px-0 mx-0">
               3 Stars
            </div>
            <div class="col-8 px-0 mx-0 pt-1">
               <div class="progress ">
                 <div class="progress-bar custom-bg-orange  " role="progressbar" style="width: {{ $avg3 }}%" aria-valuenow="{{ $avg3 }}" aria-valuemin="0" aria-valuemax="100"></div>
               </div>
           
           </div>
         </div>
        
         <div class="row">
          <div class="col-3 px-0 mx-0">
             2 Stars
          </div>
          <div class="col-8 px-0 mx-0 pt-1">
             <div class="progress ">
               <div class="progress-bar custom-bg-orange  " role="progressbar" style="width: {{ $avg2 }}%" aria-valuenow="{{ $avg2 }}" aria-valuemin="0" aria-valuemax="100"></div>
             </div>
         </div>
        </div>
        
        <div class="row">
          <div class="col-3 px-0 mx-0">
             1 Stars
          </div>
          <div class="col-8 px-0 mx-0 pt-1">
             <div class="progress ">
               <div class="progress-bar custom-bg-orange  " role="progressbar" style="width: {{ $avg1 }}%" aria-valuenow="{{ $avg1 }}" aria-valuemin="0" aria-valuemax="100"></div>
             </div>
         </div>
        </div>
        
              </div>
            </div>
        
</div>
</div>
