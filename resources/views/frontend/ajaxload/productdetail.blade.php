<div class="p-4">
    <div class="row">
        <div class="col-md-8 border-bottom pb-2">
   <h4 class="custom-fw-800 pt-2 pb-2">Description</h4>

         <p class="my-0 py-0">
            Weight: {{ $product->weight }} ft
         </p>
         <p class="my-0 py-0 mb-2">
            Dimension: {{ $product->length }}ft X  {{ $product->width }}ft X {{ $product->height }} ft
         </p>
        
         
        {!! $product->detail !!}
      </div>
    </div>
   </div>