<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Cart;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Productvariation;
use App\Models\Ecommerce\Product;
use App\Models\Ecommerce\Productcolor;
use App\Models\Ecommerce\Website;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
class CartController  extends Controller
{


    public function store(Request $request){
      // destroying coupon if applied 
      if(session()->has('coupon')){
        Session()->forget('coupon');
      }
       $request->validate([
           'qty'=>'required',
           'type'=>'required',

       ]);

 // checking stock qty 
 if(isset($request->size)){
  $qty=Productvariation::where('id',$request->size)->value('qty');
}else{
  $qty=Product::where('id',$request->pid)->value('qty');
}
// prevent adding to cart if stock qty is less than requested qty
if($qty<=0){

  
  $notification=array(
    'alert-type'=>'error',
    'messege'=>'Item out of stock',

 );
 return redirect()->back()->with($notification);
}

// prevent adding to cart if stock qty is less than requested qty

if($qty<$request->qty){
  $notification=array(
    'alert-type'=>'error',
    'messege'=>"Only $qty available in stock",

 );
 return redirect()->back()->with($notification);
}






     if(Auth::check()){ //is login or not
  if($request->type==0||$request->type==1){

    try {
     
        //checking whether same product is already store in cart or not
        if($request->type==0){
          $check=DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('product_id',$request->pid)->where('buynow',0)->first();
          if($check){
            $notification=array(
              'alert-type'=>'info',
              'messege'=>'Item already in your cart',
    
           );
           return redirect()->back()->with($notification);
          }
          
        }
        elseif($request->type==1){
          DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow',1)->delete();

        }
      
              //checking whether the selected product have attribute or not
            $color=ProductColor::find($request->color);
            $size=Productvariation::find($request->size);
            $product=Product::find($request->pid);

            $cart=new Cart;


        if(isset($request->size)){//storing  price of product if no any size is selected
            if($request->qty>$size->qty){
                $notification=array(
                    'alert-type'=>'warning',
                    'messege'=>'Less quantity amount in Stock.Please decrease your qty',

                 );
                 return redirect()->back()->with($notification);

            }
          $cart->size=$size->size;
          if($size->offer_price!=null){
            $cart->price=$size->offer_price;

          }else{
          $cart->price=$size->price;

          }
        }else{//storing defalult price of product if no any size is selected
            if($request->qty>$product->qty){
                $notification=array(
                    'alert-type'=>'warning',
                    'messege'=>'Less quantity amount in Stock.Please decrease your qty',

                 );
                 return redirect()->back()->with($notification);

            }
            if($product->offer_price!=null){
                $cart->price=$product->offer_price;

              }else{
                $cart->price=$product->price;


              }

        }

         if(isset($request->color)){ //stroring color if color is selected
            $cart->color=$color->color;
          }
            $cart->product_id=$request->pid;
            $cart->user_id=Auth::user()->id;
           $cart->qty=$request->qty;
           $cart->buynow=$request->type;
           $cart->save();

          //  if type is 0 i.e add to cart then rediect back
        if($request->type==0){
          $notification=array(
                'alert-type'=>'success',
                'messege'=>'Item added to your cart',

            );
         return redirect()->back()->with($notification);
     }
     
     elseif($request->type==1){
       $buynow=1;
     return redirect()->route('checkout',['value'=>'checkout-page','id'=>$buynow]);
     }
     
     else{
       $notification=array(
            'alert-type'=>'info',
            'messege'=>'Something went wrong. Please try again later.',

         );
         return redirect()->back()->with($notification);
     }

  }catch (\Throwable $th) {
      $notification=array(
          'alert-type'=>'error',
          'messege'=>'Something went wrong please try again later.',

       );
       return redirect()->back()->with($notification);
      }

}

}
  else{ //is login or not else case
        $notification=array(
            'alert-type'=>'info',
            'messege'=>'Please login.',

         );
         return redirect()->route('login')->with($notification);
       }




    }




    public function index(){
        if(Auth::check()){

          $cart = DB::connection('mysql')->table('carts')->join('products','carts.product_id','products.id')->select('carts.*','products.name','products.image','products.id as pid','products.delivery_charge')->where('carts.user_id',Auth::user()->id)->where('buynow',0)->get();
          
        return view('frontend.cart',compact('cart'));
      }else{

        return redirect()->route('login');

      }
      }



      public function destroy($id){

        $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('id',$id)->delete();

          $notification=array(
                          'messege'=>'Item removed from your cart',
                          'alert-type'=>'success'
                           );
                         return Redirect()->back()->with($notification);

      }


      public function update($val,$id,$price,$charge){
         if(session()->has('coupon')){
          session()->forget('coupon');

         }


           DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('id',$id)->update([
               'qty'=>$val
           ]);
           $total=$price*$val;
           $cart_total=0;
           $shipping_total=0;
           $cart=DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->get();
           foreach($cart as $item){
            $cart_total+=$item->qty*$item->price;
            $shipping_total+=$item->qty*$charge;

           }
           $grandtotal=$cart_total+$shipping_total;
           $data=[
             'total'=>$total,
             'carttotal'=>number_format((float)$cart_total,2),
             'grandtotal'=>number_format((float)$grandtotal,2),
             'charge'=>number_format((float)$shipping_total,2)

           ];
        return response()->json($data);


      }






     public function Coupon(Request $request){
       if(session()->has('coupon')){
         session()->forget('coupon');
       }
         $coupon = $request->coupon;
         $buynow = $request->buynow;

      $check = DB::connection('mysql')->table('coupons')->where('coupon',$coupon)->first();
if($buynow=='1'){
  $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow',1)->get();
}else{
  $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow','!=',1)->get();
}


      $grandtotal=0;
  foreach ($cart as $value) {
    $grandtotal+=$value->qty*$value->price;
  }

      if ($check) {

      if($check->expire_at>today()){
   
if($grandtotal>$check->card_value){

      session()->put('coupon',[
      'name' => $check->coupon,
      'discount' => $check->price,
      'balance' => $grandtotal-$$check->price,
      ]);
          $notification=array(
                          'messege'=>'Coupon Code applied successfully!',
                          'alert-type'=>'success'
                           );
                         return Redirect()->back()->with($notification);

}else{
    $notification=array(
        'messege'=>"You arenot eligible to apply this coupon.Your cart value must be more than NRP $check->card_value",
        'alert-type'=>'error'
         );
       return Redirect()->back()->with($notification);
}

      }else{


        $notification=array(
            'messege'=>'Sorry you coupon hasbeen expired',
            'alert-type'=>'error'
             );
           return Redirect()->back()->with($notification);
      }


    }

      else{
          $notification=array(
                          'messege'=>'Invalid Coupon',
                          'alert-type'=>'error'
                           );
                         return Redirect()->back()->with($notification);
      }

     }


   public function CouponRemove(){
       session()->forget('coupon');
       $notification=array(
                          'messege'=>'Coupon Code removed successfully!',
                          'alert-type'=>'success'
                           );
                         return Redirect()->back()->with($notification);

   }





}

