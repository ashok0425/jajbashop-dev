<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ecommerce\Question;
use App\Models\Ecommerce\Answer;

class ProductqaController extends Controller
{
 
public function store(Request $request){
try {
    if(Auth::check()){
        $review=new Question;
        $review->user_id=Auth::user()->id;
        $review->product_id=$request->product_id;
        $review->question=$request->question;
$review->save();
$notification=array(
  'message'=>'Thank you for your query.We will get back to you soon',
  'alert'=>'info'
   );
 return response()->json($notification);

      }else{
          $notification=array(
              'message'=>'Login inorder to place any  query',
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
public function answer(Request $request){

    try {
        if(Auth::check()){
            $review=new Answer;
            $review->user_id=Auth::user()->id;
            $review->question_id=$request->question_id;
            $review->answer=$request->answer;
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

