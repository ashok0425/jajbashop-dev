<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Cart;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Order;
use App\Models\Ecommerce\Product;
use App\Models\Ecommerce\Website;
use App\Models\Ecommerce\order_detail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mail\checkout;
use App\Models\Ecommerce\Productvariation;
use App\Models\Ecommerce\Gst;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class CheckoutController  extends Controller
{
    

  public function index($value,$id){
      if(Auth::check()){
       $buynow=$id;
       return view('frontend.checkout',compact('buynow'));
}

     
    }






  public function store(Request $request)
  {
    $request->validate([
      'name'=>'required',
      'phone'=>'required',
      'email'=>'required|email',
      'zip_code'=>'required',
      'state'=>'required',
      'city'=>'required',
      'district'=>'required',
      'address'=>'required',



    ]);
      if(Auth::check()){
      

    if($request->buynow==1){
      $cart =  DB::connection('mysql')->table('carts')->join('products','products.id','carts.product_id')->select('carts.*','products.delivery_charge','products.vendor_id','products.hsn_id')->where('carts.user_id',Auth::user()->id)->where('carts.buynow',1)->get();
    }else{
      $cart =  DB::connection('mysql')->table('carts')->join('products','products.id','carts.product_id')->select('carts.*','products.delivery_charge','products.vendor_id','products.hsn_id')->where('carts.user_id',Auth::user()->id)->where('carts.buynow',0)->get();

    }
// checking whether cart is empty or not 
   if(count($cart)<=0){
return redirect()->route("/");
   }

    $total=0;
    $charge=0;
    $amount=0;
foreach($cart as $value){
$total+=$value->qty*$value->price;
$charge+=$value->qty*$value->delivery_charge;

}
if(session()->has('coupon')){
  $amount = session()->get('coupon')['balance']+$charge;
  }else{
    $amount=$total+$charge;

  }
// try {
  // checking if payment type is prepaid then sedn to razor payment 
if($request->payment_type=='prepaid'){
  $api = new Api(env('razorpay_key_id'), env('razorpay_secret_id'));
  $order  = $api->order->create(array('receipt' => rand(), 'amount' => $amount * 100 , 'currency' => 'INR')); // Creates order
  $orderId = $order['id']; 
  
  $data = array(
    'order_id' => $orderId,
    'amount' => $amount,
    'buynow' => $request->buynow,
    'name' => $request->name,
    'phone' => $request->phone,
    'email' => $request->email,
    'state' => $request->state,
    'district' => $request->district,
    'city' => $request->city,
    'address' => $request->address,
    'zip_code' => $request->zip,
    'gst' => $request->gst,

    'bname' => $request->bname,
    'bphone' => $request->bphone,
    'bemail' => $request->bemail,
    'bstate' => $request->bstate,
    'bdistrict' => $request->bdistrict,
    'bcity' => $request->bcity,
    'baddress' => $request->baddress,
    'bzip_code' => $request->bzip,
    'bgst' => $request->bgst,




);
session()->put('prepaid',$data);
return redirect()->route('razorpay')->with('data', $data);

}elseif($request->payment_type=='cod'){

    $orderId=rand();
    $data=new Order;
    $data->user_id = Auth::user()->id;          
    $data->shipping_charge = $charge;
    $data->payment_id = uniqid();
    $data->order_id = $orderId;
    $data->payment_type =$request->payment_type;
    if(session()->has('coupon')){
    $data->coupon =  session()->get('coupon')['name'];
    $data->coupon_value =  session()->get('coupon')['discount'];
    }else{
    $data->total=$amount;
    }
    $data->status = 0;    
  $data->save();
  $order_id=$orderId;

    /// Insert Shipping Table 
    $shipping = array();
    $shipping['order_id'] = $order_id;
    $shipping['name'] = $request->name;
    $shipping['email'] = $request->email;
    $shipping['phone'] = $request->phone;
    $shipping['district'] = $request->district;
    $shipping['address'] = $request->address;
    $shipping['state'] = $request->state;
    $shipping['city'] = $request->city;
    $shipping['zip'] = $request->zip_code;
    $shipping['gst'] = $request->gst;
    DB::connection('mysql')->table('shippings')->insert($shipping);


if(isset($request->bphone)&& $request->bphone==null ||isset($request->bemail)){
  /// Insert Shipping Table 
  $shipping = array();
  $shipping['order_id'] = $order_id;
  $shipping['name'] = $request->bname;
  $shipping['email'] = $request->bemail;
  $shipping['phone'] = $request->bphone;
  $shipping['district'] = $request->bdistrict;
  $shipping['address'] = $request->baddress;
  $shipping['state'] = $request->bstate;
  $shipping['city'] = $request->bcity;
  $shipping['zip'] = $request->bzip_code;
  $shipping['gst'] = $request->bgst;

  DB::connection('mysql')->table('billings')->insert($shipping);
}


$website=Website::find(1);

// inserting all cart item 
    foreach ($cart as $row) {
         // updating product qty while checkout 
         if(isset($row->size)){
          $p=Productvariation::where('product_id',$row->product_id)->where('size',$row->size)->first();
          $p->qty=$p->qty-$row->qty;
          $p->save();
        }else{
          $p=Product::find($row->product_id);
          $p->qty=$p->qty-$row->qty;
          $p->save();
        }
        $hsn=Gst::find($row->hsn_id);
    $details=new order_detail;
    $details->order_id = $order_id;
    $details->vendor_order_id = rand().$order_id;
    $details->product_id = $row->product_id;
    $details->vendor_id = $row->vendor_id;
    $details->color = $row->color;
    $details->size = $row->size;
    $details->qty = $row->qty;
    $details->payment_type = $request->payment_type;
    $details->price = $row->price;
    $details->charge = $row->delivery_charge;
    $details->comission = $website->comission;
    $details->hsn = $hsn->hsn;
    $details->gst = $hsn->percent;
    $details->user_id = Auth::user()->id;
    $details->status = 0;
    $details->save();

    }
  
    

// sending email 
$data=DB::connection('mysql')->table('websites')->first();
$order=DB::connection('mysql')->table('orders')->where('user_id',Auth::user()->id)->where('order_id',$order_id )->first();
$ship=DB::connection('mysql')->table('shippings')->where('order_id',$order_id)->first();
  if($request->buynow==1){
$cart = DB::connection('mysql')->table('products')->join('carts','carts.product_id','products.id')->select('products.name','products.image','carts.*')->where('user_id',Auth::user()->id)->where('buynow',1)->get();
      

  }
else{
    
    $cart = DB::connection('mysql')->table('products')->join('carts','carts.product_id','products.id')->select('products.name','products.image','carts.*')->where('user_id',Auth::user()->id)->where('buynow','!=',1)->get();
}

if(count($cart)<1){
  return redirect()->route('/');
}

$set=[
    'orderId'=>$order->order_id,
    'ship_email'=>$ship->email,
      'msg'=>"Thank you for your order. Your order ID $order->order_id has been placed.",

];
$pdf = PDF::loadView('mail.checkout', $set);
   
   
    Mail::send('mail.order', $set, function($message)use($set, $pdf) {
        $message->to($set['ship_email'])
                ->subject("Thank you for your order. Your order number has been placed.")
                ->attachData($pdf->output(), "orderinvoice.pdf");
    });
       


if($request->buynow==1){
  $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow',1)->delete();

}else{
  $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow',0)->delete();
}
if (session()->has('coupon')) {
    session()->forget('coupon');

}


  return redirect()->route('payment.success',['orderid'=>$order->order_id]);
}


// }

//  catch (\Throwable $th) {
//   $notification=array(
//     'messege'=>'Something went wrong. Please try again later..',
//     'alert-type'=>'error'
//      );
// return redirect()->route('payment.error')->with($notification);
// }


}else{
$notification=array(
  'messege'=>'Please login first !',
  'alert-type'=>'error'
   );
return redirect()->route('login')->with($notification);
}


}







  public function failed(){
     if(Auth::check()){
  
    return view('errors.paymentfailed');
  }else{
    return redirect()->route('login');
  
   }
   }



    public function success($orderid){
      if(Auth::check()){
      $orderid=$orderid;
       return view('errors.success',compact('orderid'));
      }else{
       return redirect()->route('login');
  
     }
}


public function invoice(){

  // $pdf = PDF::loadView('mail.vendorinvoice');
  // return $pdf->stream();
  return view('mail.checkoutinvoice');
}
}

