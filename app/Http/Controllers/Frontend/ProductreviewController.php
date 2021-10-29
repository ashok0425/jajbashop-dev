<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Product;
// use App\Models\Ecommerce\Product;
use App\Mail\customize;
use App\Models\Ecommerce\Productvariation;
use Illuminate\Support\Facades\DB;
use App\Models\Ecommerce\Productcolor;
use Illuminate\Support\Facades\Auth;
use App\Models\Ecommerce\Productreview;
use Illuminate\Support\Facades\Mail;
use App\Mail\reportproduct;
use App\Models\Ecommerce\Avegrageproductrating;
use App\Models\Ecommerce\Reply;
use Session;
class ProductreviewController extends Controller
{
 
public function store(Request $request){

try {
    if(Auth::check()){
        $review=new Productreview;
        $review->user_id=Auth::user()->id;
        $review->product_id=$request->product_id;
        $review->rating=$request->star;
        $review->feedback=$request->comment;
        $review->save();
// storing product average rating  to Average product rating

$avrage=Productreview::where('product_id',$request->product_id)->avg('rating');
$avstore=Avegrageproductrating::where('product_id',$request->product_id)->first();

if($avstore){
    $avstore->rating=ceil($avrage) ;
    $avstore->save();

}else{
    $avstore=new Avegrageproductrating;
    $avstore->rating=ceil($avrage) ;
    $avstore->product_id=$request->product_id;
    $avstore->save();
}

$notification=array(
  'message'=>'Thank you for your Feedback',
  'alert'=>'success'
   );
 return response()->json($notification);

      }else{
          $notification=array(
              'message'=>'Login inorder to write comment',
              'alert'=>'error'
               );
               return response()->json($notification);

      }
} catch (\Throwable $th) {
    $notification=array(
        'messege'=>'Something went wrong.Please try again later',
        'alert-type'=>'error'
         );
       return Redirect()->back()->with($notification);
}
}



// storing replied comment 
public function replystore(Request $request){

    try {
        if(Auth::check()){
            $review=new Reply;
            $review->user_id=Auth::user()->id;
            $review->comment_id=$request->comment_id;
            $review->comment=$request->comment;
    $review->save();
    $notification=array(
      'message'=>'Replied Sucessfully',
      'alert'=>'success'
       );
     return response()->json($notification);
    
          }else{
              $notification=array(
                  'message'=>'Login inorder to write comment',
                  'alert'=>'error'
                   );
                   return response()->json($notification);
    
          }
    } catch (\Throwable $th) {
        $notification=array(
            'messege'=>'Something went wrong.Please try again later',
            'alert-type'=>'error'
             );
           return Redirect()->back()->with($notification);
    }
    }


public function edit(Productreview $review,$id)
{
    $re=Productreview::find($id);
    return response()->json($re);

}


public function update(Request $request)
{
    $id=$request->vid;
    $re=Productreview::find($id);
    $re->feedback=$request->feedback;
    $re->save();
    $notification=array(
        'messege'=>'Your feedback updated',
        'alert-type'=>'success'
         );
    return redirect()->back()->with($notification);

}

public function destroy(Productreview $review,$id)
{
    $re=Productreview::find($id);
    $re->delete();
    $notification=array(
        'messege'=>'Your review was deleted',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification);
}


}

