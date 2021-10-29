<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Cart;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Wishlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
class WishlistController  extends Controller
{
    

    public function store($id){
  
      try {
          //checking whether same product is already store in cart or not
       if(Auth::check()){
        $check=DB::connection('mysql')->table('wishlists')->where('user_id',Auth::user()->id)->where('product_id',$id)->first();
        if($check){
       
          DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('product_id',$id)->delete();
       $notification=array(
            'alert-type'=>'info',
            'messege'=>'Product already exist in your wishlist',
           
         );
         return redirect()->back()->with($notification);
}else{
  $wish=new Wishlist;
   $wish->product_id=$id;
   $wish->user_id=Auth::user()->id;


        if($wish->save()){
          DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('product_id',$id)->delete();
          $notification=array(
                'alert-type'=>'success',
                'messege'=>'Item added to your wishlist',
              
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
         return redirect()->back()->with($notification);
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



    
// wishlist page

    public function index(){
        if(Auth::check()){
  
          $wish = DB::connection('mysql')->table('wishlists')->join('products','wishlists.product_id','products.id')->select('wishlists.*','products.name','products.image','products.id as pid','products.price','products.short_desc')->where('wishlists.user_id',Auth::user()->id)->get();
        return view('frontend.wishlist',compact('wish'));
      }else{
        return redirect()->route('login');
  
      }
      }



      public function destroy($id){
    
         DB::connection('mysql')->table('wishlists')->where('user_id',Auth::user()->id)->where('id',$id)->delete();
        
          $notification=array(
                          'messege'=>'Item removed from your wishlist',
                          'alert-type'=>'success'
                           );
                         return Redirect()->back()->with($notification);
  
      }


      // add o cart from wishlist 
  public function cart(Request $request,$id){
     
    $check=DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('product_id',$id)->first();
if($check){
$wish= DB::connection('mysql')->table('wishlists')->where('user_id',Auth::user()->id)->where('product_id',$id)->delete();
  $notification=array(
    'messege'=>'Item added to your cart',
    'alert-type'=>'success'
     );
   return Redirect()->back()->with($notification);
}else{

      $price=DB::connection('mysql')->table('products')->where('id',$id)->first();
      $cart=new Cart;
      $cart->user_id=Auth::user()->id;
      $cart->product_id=$id;
      if($price->offer_price){
        $cart->price=$price->offer_price;

      }else{
        $cart->price=$price->price;

      }
      $cart->qty=1;

      if($cart->save()){
        $cart = DB::connection('mysql')->table('wishlists')->where('user_id',Auth::user()->id)->where('product_id',$id)->delete();
        $notification=array(
          'messege'=>'Item added to your
cart',
          'alert-type'=>'success'
           );
         return Redirect()->back()->with($notification);
      }
    }


  }
      


}

