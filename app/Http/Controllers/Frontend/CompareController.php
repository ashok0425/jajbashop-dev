<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Cart;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Wishlist;
use App\Models\Ecommerce\Compareproduct;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
class CompareController  extends Controller
{
    

    public function store(Request $request,$id){
  
      try {
          //checking whether same product is already store in cart or not
       if(Auth::check()){
        $check=DB::connection('mysql')->table('compareproducts')->where('user_id',Auth::user()->id)->where('product_id',$id)->first();
        if($check){
       
       $notification=array(
            'alert-type'=>'info',
            'messege'=>'Product already exist in your compare list',
           
         );
         return redirect()->back()->with($notification);
}else{
  $wish=new Compareproduct;
   $wish->product_id=$id;
   $wish->user_id=Auth::user()->id;


        if($wish->save()){
          $notification=array(
                'alert-type'=>'success',
                'messege'=>'Item added to your compare list',
              
            );
         return redirect()->back()->with($notification);
     }else{
       $notification=array(
            'alert-type'=>'info',
            'messege'=>'Something went wrong.please try again',
           
         );
         return redirect()->back()->with($notification);
     }
}
  }else{
        $notification=array(
            'alert-type'=>'info',
            'messege'=>'Please login.',
           
         );
         return redirect()->route('login')->with($notification);
       }
      }

catch (\Throwable $th) {
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Something went wrong please try again later.',
       
     );
     return redirect()->back()->with($notification);
    }
    }



    


    public function index(){
        if(Auth::check()){
  
          $compare = DB::connection('mysql')->table('compareproducts')->orderBy('id','desc')->where('compareproducts.user_id',Auth::user()->id)->get();
        return view('frontend.comparelist',compact('compare'));
      }else{
        return redirect()->route('login');
  
      }
      }



      public function destroy($id){
    
        $cart = DB::connection('mysql')->table('compareproducts')->where('user_id',Auth::user()->id)->where('id',$id)->delete();
        
          $notification=array(
                          'messege'=>'Item removed from your Compare list',
                          'alert-type'=>'success'
                           );
                         return Redirect()->back()->with($notification);
  
      }



}

