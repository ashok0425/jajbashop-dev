<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Ecommerce\Avegragesellerrating;
use App\Models\Ecommerce\Sellerreply;
use App\Models\Ecommerce\Sellerreview;

class SellerreviewController extends Controller
{
 
public function store(Request $request){

try {
    if(Auth::check()){
        $review=new Sellerreview;
        $review->user_id=Auth::user()->id;
        $review->seller_id=$request->seller_id;
        $review->rating=$request->star;
        $review->feedback=$request->comment;
        $review->save();
// storing product average rating  to Average product rating

$avrage=Sellerreview::where('seller_id',$request->seller_id)->avg('rating');
$avstore=Avegragesellerrating::where('seller_id',$request->seller_id)->first();

if($avstore){
    $avstore->rating=ceil($avrage) ;
    $avstore->save();

}else{
    $avstore=new Avegragesellerrating;
    $avstore->rating=ceil($avrage) ;
    $avstore->seller_id=$request->seller_id;
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
public function replystore (Request $request){

    try {
        if(Auth::check()){
            $review=new Sellerreply;
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


public function edit(Sellerreview $review,$id)
{
    $re=Sellerreview::find($id);
    return response()->json($re);

}


public function update(Request $request)
{
    $id=$request->vid;
    $re=Sellerreview::find($id);
    $re->feedback=$request->feedback;
    $re->save();
    $notification=array(
        'messege'=>'Your feedback updated',
        'alert-type'=>'success'
         );
    return redirect()->back()->with($notification);

}

public function destroy(Sellerreview $review,$id)
{
    $re=Sellerreview::find($id);
    $re->delete();
    $notification=array(
        'messege'=>'Your review was deleted',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification);
}


}

