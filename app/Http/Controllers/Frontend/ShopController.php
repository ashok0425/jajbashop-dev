<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Shop;
use App\Models\Ecommerce\Shopreview;
use App\Models\Ecommerce\Favourite;
use Illuminate\Support\Facades\Auth;
use DB;
class ShopController extends Controller
{


   

    public function Shop($id,$name){

        try {
            
            $shop=Shop::find($id);
            return view('frontend.shop',compact('shop'));

        } catch (\Throwable $th) {
            $notification=array(
                'alert-type'=>'error',
                'messege'=>'Something went wrong.Please try again later',
                
             );
             return redirect()->back()->with($notification);
        }
        
        
            }




            public function ratingStore(Request $request){
                $request->validate([
                    'rating'=>'required'
                  
                
                ]);
                // try {
                    if(Auth::check()){
                        $review=new Shopreview;
                        $review->user_id=Auth::user()->id;
                        $review->shop_id=$request->shop_id;
                
                        $review->rating=$request->rating;
                        $review->feedback=$request->review;
                $review->save();
                $notification=array(
                  'messege'=>'Thank you for your Feedback',
                  'alert-type'=>'success'
                   );
                 return Redirect()->back()->with($notification);
                
                      }else{
                          $notification=array(
                              'messege'=>'Please Login',
                              'alert-type'=>'info'
                               );
                          return redirect()->back()->with($notification);
                      }
                // } catch (\Throwable $th) {
                //     $notification=array(
                //         'messege'=>'Something went wrong.Please try again later',
                //         'alert-type'=>'error'
                //          );
                //       return Redirect()->back()->with($notification);
                // }
                }
                
                
                
                public function ratingEdit(Shopreview $review,$id)
                {
                    $re=Shopreview::find($id);
                    return response()->json($re);
                
                }
                
                
                public function ratingUpdate(Request $request)
                {
                
                    $id=$request->vid;
                    $re=Shopreview::find($id);
                    $re->feedback=$request->feedback;
                    $re->save();
                    $notification=array(
                        'messege'=>'Your feedback updated',
                        'alert-type'=>'success'
                         );
                    return redirect()->back()->with($notification);
                
                }
                
                public function ratingDestroy(Shopreview $review,$id)
                {
                    $re=Shopreview::find($id);
                    $re->delete();
                    $notification=array(
                        'messege'=>'Your review was deleted',
                        'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
                }
                

public function favourite($id){
if(Auth::check()){
    $check=Favourite::where('user_id',Auth::user()->id)->where('shop_id',$id)->first();
    if(!$check){

$fav=new Favourite;
$fav->user_id=Auth::user()->id;
$fav->shop_id=$id;
$fav->save();
$notification=array(
    'messege'=>'Shop added to your favourite ',
    'alert-type'=>'success'
     );
   return Redirect()->back()->with($notification);
}else{
    $notification=array(
        'messege'=>'Already added to your favourite',
        'alert-type'=>'info'
         );
       return Redirect()->back()->with($notification); 
}
}else{
    $notification=array(
        'messege'=>'Login Please',
        'alert-type'=>'info'
         );
       return Redirect()->route('login')->with($notification); 
}

}

public function remove($id){
DB::connection('mysql')->table('favourites')->where('shop_id',$id)->where('user_id',Auth::user()->id)->delete();
$notification=array(
    'alert-type'=>'success',
    'messege'=>'Shop remove from favourite list',
    
 );
 return redirect()->back()->with($notification);
}


}
