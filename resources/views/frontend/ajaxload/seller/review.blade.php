<style>
  
  .comment-thread {
   
    margin: auto;
    padding: 0 30px;
    background-color: #fff;
    border: 1px solid transparent; /* Removes margin collapse */
}
.m-0 {
    margin: 0;
}


/* Comment */

.comment {
    position: relative;
    margin: 20px auto;
}
.comment-heading {
    display: flex;
    align-items: center;
    height: 50px;
    font-size: 14px;
}
.comment-voting {
    width: 20px;
    height: 32px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 4px;
}
.comment-voting button {
    display: block;
    width: 100%;
    height: 50%;
    padding: 0;
    border: 0;
    font-size: 10px;
}
.comment-info {
    color: rgba(0, 0, 0, 0.5);
    margin-left: 10px;
}
.comment-author {
    color: rgba(0, 0, 0, 0.85);
    font-weight: bold;
    text-decoration: none;
}
.comment-author:hover {
    text-decoration: underline;
}
.replies {
    margin-left: 20px;
}

/* Adjustments for the comment border links */

.comment-border-link {
    display: block;
    position: absolute;
    top: 50px;
    left: 0;
    width: 12px;
    height: calc(100% - 50px);
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    background-color: rgba(0, 0, 0, 0.1);
    background-clip: padding-box;
}
.comment-border-link:hover {
    background-color: rgba(0, 0, 0, 0.3);
}
.comment-body {
    padding: 0 20px;
    padding-left: 28px;
}
.replies {
    margin-left: 28px;
}

/* Adjustments for toggleable comments */

details.comment summary {
    position: relative;
    list-style: none;
    cursor: pointer;
}
details.comment summary::-webkit-details-marker {
    display: none;
}
details.comment:not([open]) .comment-heading {
    border-bottom: 1px solid rgba(0, 0, 0, 0.2);
}
.comment-heading::after {
    display: inline-block;
    position: absolute;
    right: 5px;
    align-self: center;
    font-size: 12px;
    color: rgba(0, 0, 0, 0.55);
}


/* Adjustment for Internet Explorer */

@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
    /* Resets cursor, and removes prompt text on Internet Explorer */
    .comment-heading {
        cursor: default;
    }
    details.comment[open] .comment-heading::after,
    details.comment:not([open]) .comment-heading::after {
        content: " ";
    }
}

/* Styling the reply to comment form */

.reply-form textarea,.reply-form textarea,  .reply-forms textarea {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    font-size: 16px;
    width: 100%;
    max-width: 100%;
    margin-top: 15px;
    margin-bottom: 5px;
}



</style>
<div class="p-4">
<div class="row pb-2 pt-2 border-top border-bottom ">
  <div class="col-md-6">
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

  {{-- rate and write review  --}}
  <div class="col-md-6 ">
    <p class="my-1">Have you used this product before?</p>
    <p class="my-1">Rate it: *</p>
  <form method="GET" class="reply-forms submit" action="{{ route('seller.rating.store') }}">
@csrf
<input type="hidden" name="seller_id" value="{{ $id }}">
      <div class="d-flex">
          <div class="star-container">
              <input type="radio" name="star" value="5" id="5" class="radio">
              <label class="label" for="5">
               <span class="star ">
                &#x2729;
               </span>
              </label>

              <input type="radio" name="star" value="4" id="4" class="radio">
              <label class="label" for="4">
                <span class="star">
                  &#x2729;
                 </span>
              </label>

              <input type="radio" name="star" value="3" id="3" class="radio">
              <label class="label" for="3">
                <span class="star">
                  &#x2729;
                 </span>
              </label>

              <input type="radio" name="star" value="2" id="2" class="radio">
              <label class="label" for="2">
                <span class="star">
                  &#x2729;
                 </span>
              </label>

              <input type="radio" name="star" value="1" id="1" class="radio">
              <label class="label" for="1">
                <span class="star">
                  &#x2729;
                 </span>
              </label>
          </div>
    
  </div>
    <textarea placeholder="Write comment" rows="4" name="comment" required></textarea>
    <button class="btn btn-success border-0 custom-br-0 outline-0 py-2 px-3 mt-2 ">Write A Review</button>

</form>


  </div>
  {{-- rate and write review end --}}

</div>


  <div class="comment-thread">
    <!-- Comment 1 start -->
    <details open class="comment" id="comment-1">
      @foreach ($rating as $item)
    
    <summary>
        <div class="comment-heading">
          
            <div class="comment-info">
                <a class="comment-author d-flex align-items-center text-decoration-none mb-0 pb-0">
                  <img src=" @if(isset($item->profile_photo_path))
                  {{ asset($item->profile_photo_path)}}
                   @else {{ asset('frontend/user.png') }} @endif" alt="{{ $item->name }}" class="img-fluid rounded-circle" width="40" height="40"> {{ $item->name }}  
                   @if ($item->user_id==$id)
                   &nbsp;  <span class="badge bg-success"> verified Seller</span>
               @endif
                   </a>
                 
                  <span class="d-flex justify-content-left align-items-center mt-0 pt-0">
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    @for ($i = 0; $i < $item->rating; $i++)
                      <span class=" custom-text-orange custom-fs-20">
                       <i class="fas fa-star"></i>
                       </span>
                    @endfor 
                    @for ($i = 0; $i < 5-$item->rating; $i++)
                      <span class="custom-fs-20 ">
                       <i class="fas fa-star"></i>
                       </span>
                        
                    @endfor &nbsp;{{ carbon\carbon::parse($item->created_at)->diffForHumans() }}
                  
               
                  </span>  
            </div>
        </div>
    </summary>

    <div class="comment-body my-3">
        <p class="my-1">
            {{ $item->feedback }}
        </p>
        <a class="custom-fw-400 reply-form-link"  data-id="comment-{{ $item->id }}-reply-form" href="#">Reply</a>

        <!-- Reply form start -->
        <form method="GET" class="reply-form d-none reply" id="comment-{{ $item->id }}-reply-form" action="{{ route('seller.rating.reply.store') }}">
          @csrf
          <input type="hidden" name="comment_id" value="{{ $item->id }}">
            <textarea placeholder="Reply to comment" rows="2" name="comment" required></textarea>
            <button type="submit" class="badge custom-bg-primary border-0 outline-none ">Submit</button>
            <a  class="badge bg-dark border-0 outline-none cancel text-decoration-none text-white" data-id="comments-{{ $item->id }}-reply-form" href="#">Cancel</a>

        </form>
        <!-- Reply form end -->
        {{-- fetching reply  --}}
    @php
        $reply=DB::connection('mysql2')->table('sellerreplies')->join('users','users.id','sellerreplies.user_id')->select('users.name','users.id as uid','sellerreplies.*')->where('comment_id',$item->id)->get();
    @endphp
    @foreach ($reply as $items)
    <div class="replies">
      <!-- Comment 2 start -->
      <details open class="comment" id="comment-2">
        
          <summary>
        
                  <div class="comment-info">
                    <a class="comment-author d-flex align-items-center text-decoration-none mb-0 pb-0">
                      <img src=" @if(isset($items->profile_photo_path))
                      {{ asset($items->profile_photo_path)}}
                       @else {{ asset('frontend/user.png') }} @endif" alt="{{ $items->name }}" class="img-fluid rounded-circle" width="40" height="40"> {{ $items->name }} 
                       
                       @if ($items->user_id==$id)
                       &nbsp;  <span class="badge bg-success">verified Seller</span>
                   @endif
                       </a>
                       <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ carbon\carbon::parse($items->created_at)->diffForHumans() }}</span>
                  </div>
          </summary>

          <div class="comment-body">
              <p>
                  {{ $items->comment }}
              </p>
              <a class="custom-fw-400 reply-form-link"  data-id="comments-{{ $items->id }}-reply-form" href="#">Reply</a>

              <!-- Reply form start -->
              <form method="GET" class="reply-form d-none reply" id="comments-{{ $items->id }}-reply-form" action="{{ route('product.rating.reply.store') }}">
                @csrf
                <input type="hidden" name="comment_id" value="{{ $item->id }}">
                  <textarea placeholder="Reply to comment" rows="2" name="comment" required></textarea>
                  <button type="submit" class="badge custom-bg-primary border-0 outline-none">Submit</button>
                  <a  class="badge bg-dark border-0 outline-none cancel text-decoration-none" data-id="comments-{{ $items->id }}-reply-form" href="#">Cancel</a>
           
              </form>
          </div>
      </details>
      <!-- Comment 2 end -->
{{-- 
      <a href="#load-more">Load more replies</a> --}}
  </div>
    @endforeach
        
    </div>

      @endforeach
   
    </details>
    <!-- Comment 1 end -->
    {{-- {{ $rating->links() }} --}}
</div>
</div>
</div>

<script>
  // storing rating 
  $('.submit').submit(function(e){
    e.preventDefault()
    toastr.options = {
      "closeButton": true,
      "newestOnTop": true,
      "positionClass": "toast-top-right"
    };
    let data=$(this).serialize();
    let url =$(this).attr('action');
    let method =$(this).attr('method');

    $.ajax({
      url:url,
      type:method,
      data:data,
      dataType:'json',
      beforeSend:function(){
        $(".detail").html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");
	},
			 success:function(res){
         console.log(res);
        let alert_tpe=res.alert;
      switch (alert_tpe) {
          case 'success':
          toastr.success(res.message);

              break;
              case 'error':
          toastr.error(res.message);

              break;
              case 'warning':
          toastr.warning(res.message);

              break;
              case 'info':
          toastr.info(res.message);

              break;
          default:
              break;
      }
        loadproductDetail(3,{{ $id }})   


  },
    })

  })



  // Replying rating 
  $('.reply').submit(function(e){
    e.preventDefault()
    toastr.options = {
      "closeButton": true,
      "newestOnTop": true,
      "positionClass": "toast-top-right"
    };
    let data=$(this).serialize();
    let url =$(this).attr('action');
    let method =$(this).attr('method');

    $.ajax({
      url:url,
      type:method,
      data:data,
      dataType:'json',
      beforeSend:function(){
        $(".detail").html("<div class='d-flex justify-content-center py-5'><div class='spinner-border custom-text-primary text-center ' role='status'></div></div>");
	},
			 success:function(res){
         console.log(res);
        let alert_tpe=res.alert;
      switch (alert_tpe) {
          case 'success':
          toastr.success(res.message);

              break;
              case 'error':
          toastr.error(res.message);

              break;
              case 'warning':
          toastr.warning(res.message);

              break;
              case 'info':
          toastr.info(res.message);

              break;
          default:
              break;
      }
        loadproductDetail(3,{{ $id }})   


  },
    })

  })



// reply form open close 
  $('.reply-form-link').click(function(e){
    e.preventDefault()
    $('.reply-form').addClass('d-none')
    let form=$(this).data('id');
    $('#'+form).toggleClass('d-none');

  })

  $('.cancel').click(function(e){
    e.preventDefault()
    let id=$(this).data('id');
    $(this).parent().addClass('d-none');


  })
</script>

