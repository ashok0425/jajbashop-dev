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
  
  /* Styling the Add Answer form */
  
  .reply-form textarea,  .reply-forms textarea  {
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
   
    {{-- rate and write review  --}}
    <div class="col-md-8 ">
      <p class="my-1">Have Any query?</p>
    <form method="GET" class="reply-forms submit" action="{{ route('product.question.store') }}">
  @csrf
  <input type="hidden" name="product_id" value="{{ $id }}">
      <textarea placeholder="Ask Anything..." rows="2" name="question" required></textarea>
      <button class="btn btn-success border-0 custom-br-0 outline-0 py-2 px-3 mt-2 ">Ask</button>
  
  </form>
  
  
    </div>
    {{-- rate and write review end --}}
  
  </div>
  
  
    <div class="comment-thread">
      <!-- Comment 1 start -->
      <details open class="comment" id="comment-1">
        @foreach ($question as $item)
      
      <summary>
          <div class="comment-heading">
            
              <div class="comment-info">
                  <a class="comment-author d-flex align-items-center text-decoration-none mb-0 pb-0">
                    <img src=" @if(isset($item->profile_photo_path))
                    {{ asset($item->profile_photo_path)}}
                     @else {{ asset('frontend/user.png') }} @endif" alt="{{ $item->name }}" class="img-fluid rounded-circle" width="40" height="40"> {{ $item->name }}  
                     </a>
                   
                    <span class="d-flex justify-content-left align-items-center mt-0 pt-0">
                      &nbsp;
                      &nbsp;
                      &nbsp;
                       {{ carbon\carbon::parse($item->created_at)->diffForHumans() }}
                      &nbsp;

                       @if ($item->user_id==$seller->id)
                       <span class="badge bg-success">verified Seller</span>
                   @endif
                    
                    </span>  
              </div>
          </div>
      </summary>
  
      <div class="comment-body my-3">
          <p class="my-1">
              {{ $item->question }}
          </p>
          <a class="custom-fw-400 reply-form-link"  data-id="comment-{{ $item->id }}-reply-form" href="#">Reply</a>
  
          <!-- Reply form start -->
          <form method="GET" class="reply-form d-none reply" id="comment-{{ $item->id }}-reply-form" action="{{ route('product.answer.store') }}">
            @csrf
            <input type="hidden" name="question_id" value="{{ $item->id }}">
              <textarea placeholder="Add Answer" rows="2" name="answer" required></textarea>
              <button type="submit" class="badge custom-bg-primary border-0 outline-none ">Submit</button>
              <a  class="badge bg-dark border-0 outline-none cancel text-decoration-none text-white" data-id="comments-{{ $item->id }}-reply-form" href="#">Cancel</a>
  
          </form>
          <!-- Reply form end -->
          {{-- fetching reply  --}}
      @php
          $answer=DB::connection('mysql')->table('answers')->join('users','users.id','answers.user_id')->select('users.name','users.id as uid','answers.*')->where('question_id',$item->id)->get();
      @endphp
      @foreach ($answer as $items)
      <div class="replies">
        <!-- Comment 2 start -->
        <details open class="comment" id="comment-2">
          
            <summary>
          
                    <div class="comment-info">
                      <a class="comment-author d-flex align-items-center text-decoration-none mb-0 pb-0">
                        <img src=" @if(isset($items->profile_photo_path))
                        {{ asset($items->profile_photo_path)}}
                         @else {{ asset('frontend/user.png') }} @endif" alt="{{ $items->name }}" class="img-fluid rounded-circle" width="40" height="40"> {{ $items->name }}  
                         </a>
                         <span>&nbsp;&nbsp;&nbsp;&nbsp;{{ carbon\carbon::parse($items->created_at)->diffForHumans() }}  
                            &nbsp;
                            @if ($items->user_id==$seller->id)
                                <span class="badge bg-success">verified Seller</span>
                            @endif
                        </span>
                    </div>
            </summary>
  
            <div class="comment-body">
                <p>
                    {{ $items->answer }}
                </p>
                <a class="custom-fw-400 reply-form-link"  data-id="comments-{{ $items->id }}-reply-form" href="#">Reply</a>
  
                <!-- Reply form start -->
                <form method="GET" class="reply-form d-none reply" id="comments-{{ $items->id }}-reply-form" action="{{ route('product.answer.store') }}">
                  @csrf
                  <input type="hidden" name="question_id" value="{{ $item->id }}">
                    <textarea placeholder="Add Answer" rows="2" name="answer" required></textarea>
                    <button type="submit" class="badge custom-bg-primary border-0 outline-none">Submit</button>
                    <a  class="badge bg-dark border-0 outline-none cancel text-decoration-none" data-id="comments-{{ $items->id }}-reply-form" href="#">Cancel</a>
             
                </form>
            </div>
        </details>
        <!-- Comment 2 end -->
  
    </div>
      @endforeach
          
      </div>
  
        @endforeach
     
      </details>
      <!-- Comment 1 end -->
     
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
          loadproductDetail(5,{{ $id }})   
  
  
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
          loadproductDetail(5,{{ $id }})   
  
  
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
  
  