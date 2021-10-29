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
      </div>
    </div>
</div>