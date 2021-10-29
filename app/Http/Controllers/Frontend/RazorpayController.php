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
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayController  extends Controller
{
    

  public function index(){
    if(Session::has('data')){
      return view('frontend.razorpay');   

    }else{
      return redirect()->route('/');
    }
    }

    public function pay(Request $request){
      $razor = $request->all();
      $api = new Api('rzp_live_PhKGhBy4ECQvn9', 'SxEJLrU31vHEXe1EctW7tSjX');
      $datas=session()->get('prepaid');
      try{
      $attributes = array(
           'razorpay_signature' => $razor['razorpay_signature'],
           'razorpay_payment_id' => $razor['razorpay_payment_id'],
           'razorpay_order_id' => $razor['razorpay_order_id']
      );
      $order = $api->utility->verifyPaymentSignature($attributes);
      $success = true;
  }catch(SignatureVerificationError $e){

      $succes = false;
  }

      
  if($success){
    if($datas['buynow']==1){
      $cart =  DB::connection('mysql')->table('carts')->join('products','products.id','carts.product_id')->select('carts.*','products.delivery_charge','products.vendor_id')->where('carts.user_id',Auth::user()->id)->where('carts.buynow',1)->get();
    }else{
      $cart =  DB::connection('mysql')->table('carts')->join('products','products.id','carts.product_id')->select('carts.*','products.delivery_charge','products.vendor_id')->where('carts.user_id',Auth::user()->id)->where('carts.buynow',0)->get();
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


    $data=new Order;
    $data->user_id = Auth::user()->id;          
    $data->shipping_charge = $charge;
    $data->payment_id = $razor['razorpay_payment_id'];
    $data->order_id = $razor['razorpay_order_id'];
    $data->payment_type ='Prepaid';
    if(session()->has('coupon')){
    $data->coupon =  session()->get('coupon')['name'];
    $data->coupon_value =  session()->get('coupon')['discount'];
    }else{
    $data->total=$amount;
    }
    $data->status = 0;    
  $data->save();
  $order_id=$data->id;
  $razor_id=$data->order_id;
    /// Insert Shipping Table 
    $shipping = array();
    $shipping['order_id'] = $order_id;
    $shipping['name'] = $datas['name'];
    $shipping['email'] = $datas['email'];
    $shipping['phone'] = $datas['phone'];
    $shipping['district'] = $datas['district'];
    $shipping['address'] = $datas['address'];
    $shipping['state'] = $datas['state'];
    $shipping['city'] = $datas['city'];
    $shipping['zip'] = $datas['zip_code'];
    $shipping['gst'] = $datas['gst'];

    DB::connection('mysql')->table('shippings')->insert($shipping);


if(isset($request->bphone)&& $request->bphone==null ||isset($request->bemail)){
  /// Insert Shipping Table 
  $shipping = array();
  $shipping['order_id'] = $order_id;
  $shipping['name'] = $datas['bname'];
  $shipping['email'] = $datas['bemail'];
  $shipping['phone'] = $datas['bphone'];
  $shipping['district'] = $datas['bdistrict'];
  $shipping['address'] = $datas['baddress'];
  $shipping['state'] = $datas['bstate'];
  $shipping['city'] = $datas['bcity'];
  $shipping['zip'] = $datas['bzip_code'];
  $shipping['gst'] = $datas['bgst'];

  DB::connection('mysql')->table('billings')->insert($shipping);
}


$website=Website::find(1);

// inserting all cart item 
    foreach ($cart as $row) {
      if(isset($row->size)){
        $p=Productvariation::where('product_id',$row->product_id)->where('size',$row->size)->first();
        $p->qty=$p->qty-$row->qty;
        $p->save();
      }else{
        $p=Product::find($row->product_id);
        $p->qty=$p->qty-$row->qty;
        $p->save();
      }
    $details=new order_detail;
    $details->order_id = $order_id;
    $details->user_id = Auth::user()->id;
    $details->product_id = $row->product_id;
    $details->vendor_order_id = rand().$order_id;
    $details->vendor_id = $row->vendor_id;
    $details->color = $row->color;
    $details->size = $row->size;
    $details->qty = $row->qty;
    $details->price = $row->price;
    $details->charge = $row->delivery_charge;
    $details->comission = $website->comission;
    $details->payment_type = 'Prepaid';
    $details->gst = $row->price;
    $details->status = 0;
    $details->save();

    }
  
    

// sending email 
$data=DB::connection('mysql')->table('websites')->first();
$order=DB::connection('mysql')->table('orders')->where('user_id',Auth::user()->id)->where('id',$order_id )->first();
$ship=DB::connection('mysql')->table('shippings')->where('order_id',$order_id)->first();
  if($datas['buynow']==1){
$cart = DB::connection('mysql')->table('products')->join('carts','carts.product_id','products.id')->select('products.name','products.image','carts.*')->where('user_id',Auth::user()->id)->where('buynow',1)->get();
      

  }
else{
    
    $cart = DB::connection('mysql')->table('products')->join('carts','carts.product_id','products.id')->select('products.name','products.image','carts.*')->where('user_id',Auth::user()->id)->where('buynow','!=',1)->get();
}

if(count($cart)<1){
  return redirect()->route('/');
}

$set=[
    'order_id'=>$order->id,
    'email'=>$data->email,
    'ship_email'=>$ship->email,
      'msg'=>"Thank you for your order. Your order ID $order->order_id has been placed.",

];

return response()->json('success');


// $pdf = PDF::loadView('mail.checkout', $set);
   
   
   
//     Mail::send('mail.order', $set, function($message)use($set, $pdf) {
//         $message->to($set['ship_email'])
//                 ->subject("Thank you for your order. Your order number has been placed.")
//                 ->attachData($pdf->output(), "orderinvoice.pdf");
//     });
       
  
//     Mail::send('mail.order', $set, function($message)use($set, $pdf) {
//         $message->to($set['email'])
//                 ->subject("Thank you for your order. Your order number has been placed.")
//                 ->attachData($pdf->output(), "orderinvoice.pdf");
//     });


if($datas['buynow']==1){
  $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow',1)->delete();

}else{
  $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow',0)->delete();
}
if (session()->has('coupon')) {
    session()->forget('coupon');

}
      return redirect()->route('payment.success',['orderid'=>$razor_id]);

  }else{
    return redirect()->route('payment.error');


  }

    

     

  }





}

