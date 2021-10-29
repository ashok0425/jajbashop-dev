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
use Illuminate\Support\Facades\Mail;

class EsewaController  extends Controller
{
    
public function esewa(Request $request){

  $total=$request->total;
  $vat=$request->vat;
  $charge=$request->charge;
  $cart=$request->cart;
  $fname=$request->fname;
  $lname=$request->lname;
  $zip=$request->zip;
  $state=$request->state;
  $city=$request->city;
  $phone=$request->phone;
  $email=$request->email;
  $payment=$request->payment;
  $pid=$request->pid;
  $buynow=$request->buynow;


 $data= Session::put('data',[
  'total'=>$total,
  'vat'=>$vat,
  'charge'=>$charge,
  'cart'=>$cart,
  'fname'=>$fname,
  'lname'=>$lname,
  'zip'=>$zip,
  'state'=>$state,
  'city'=>$city,
  'phone'=>$phone,
  'email'=>$email,
  'payment'=>$payment,
  'pid'=>$pid,
  'buynow'=>$buynow,


 ]);
 return response()->json('success');
}

  

    
     
      


      public function verify(Request $request)
      {
  
  
          $status = $request->q;
          // dd($status);
          $oid = $request->oid;
          $refId = $request->refId;
          $amt = $request->amt;
          // dump($oid, $refId, $amt);
  
          if ($status == 'su') {
              $url = "https://esewa.com.np/epay/transrec";
              $data = [
                  'amt' => $amt,
                  'rid' => $refId,
                  'pid' => $oid,
                  'scd' => 'NP-ES-DABALIENT',
              ];
  
              $curl = curl_init($url);
              curl_setopt($curl, CURLOPT_POST, true);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
              $response = curl_exec($curl);
              curl_close($curl);
              if (strpos($response, "Success") !== false) {
                  




                $data=new Order;
                $data->user_id = Auth::user()->id;
                $data->total = session()->get('data')['total'];          
                $data->shipping_charge = session()->get('data')['charge'];
                $data->tax = session()->get('data')['vat'];
                $data->payment_id = session()->get('data')['pid'];
                $data->payment_type =session()->get('data')['payment'];
                $data->tracking_code =  uniqid();
                $data->cart_value = session()->get('data')['cart'];
                if(Session::has('coupon')){
                $data->coupon =  Session::get('coupon')['name'];
                $data->coupon_value =  Session::get('coupon')['discount'];
            }
                $data->status = 0;    
                $data->ispaid = 1;    

              $data->save();
              $order_id=$data->id;
                /// Insert Shipping Table 
                $shipping = array();
                $shipping['order_id'] = $order_id;
                // $shipping['vendor_id'] = $request->Auth::user()->id;
                $shipping['name'] = session()->get('data')['fname'].' '.session()->get('data')['lname'];
                $shipping['email'] = session()->get('data')['email'];
                $shipping['phone'] = session()->get('data')['phone'];
                $shipping['state'] = session()->get('data')['state'];
                $shipping['city'] = session()->get('data')['city'];
            
                $shipping['zip'] = session()->get('data')['zip'];
            
            
                DB::connection('mysql')->table('shippings')->insert($shipping);
            
             
            
                if(session()->get('data')['buynow']==1){
                  $content =  DB::connection('mysql')->table('carts')->join('products','products.id','carts.product_id')->select('carts.*','products.price as Pprice','products.comission','products.vendor_id')->where('carts.user_id',Auth::user()->id)->where('carts.buynow',1)->get();
                }else{
                  $content =  DB::connection('mysql')->table('carts')->join('products','products.id','carts.product_id')->select('carts.*','products.price as Pprice','products.comission','products.vendor_id')->where('carts.user_id',Auth::user()->id)->where('carts.buynow','!=',1)->get();
            
                }
            // inserting all cart item 
               
                foreach ($content as $row) {
                  $p=Product::find($row->product_id);
                  $p->qty=$p->qty-$row->qty;
                  $p->save();
                  $details=new order_detail;
                $details->order_id = $order_id;
                $details->product_id = $row->product_id;
                $details->vendor_id = $row->vendor_id;
            
                $details->color = $row->color;
                $details->size = $row->size;
                $details->qty = $row->qty;
                if($row->coupon!=''){
                  $details->price_after_comission = $row->price;
            
                }else{
                $details->price_after_comission = $row->price_after_comission;
            
                }
                $details->coupon = $row->coupon;
                $details->coupon_value = $row->coupon_value;
             
                $details->price_after_coupon = $row->price;
                if($row->coupon!=''){
                  $details->price = $row->actual_price-($row->actual_price*$row->coupon_value/100);
            
                }else{
                $details->price = $row->actual_price;
            
                }
                $details->actual_price = $row->actual_price;
            
                $details['uid'] = uniqid();
                $details->comission = $row->comission;
            
            $details->save();
            
                }
               
                Session::forget('data');

                // return redirect()->route('payment.success',['orderid'=>$data->tracking_code]);
            
            // sending email 
            $data=DB::connection('mysql')->table('websites')->first();
            $order=DB::connection('mysql')->table('orders')->where('user_id',Auth::user()->id)->where('id',$order_id )->first();
            $ship=DB::connection('mysql')->table('shippings')->where('order_id',$order_id)->first();
              if($request->buynow==1){
            
            $cart = DB::connection('mysql')->table('products')->join('carts','carts.product_id','products.id')->select('products.name','products.image','carts.*')->where('user_id',Auth::user()->id)->where('buynow',1)->get();
                  
              }
            else{
                
                $cart = DB::connection('mysql')->table('products')->join('carts','carts.product_id','products.id')->select('products.name','products.image','carts.*')->where('user_id',Auth::user()->id)->where('buynow','!=',1)->get();
            }
            
            
            
            $set=[
                'image'=>$data->image,
                'email'=>$data->email1,
                'cart'=>$cart,
                'address'=>$data->address1,
                'phone'=>$data->phone1,
                'email'=>$data->email1,
            
                'ship_email'=>$ship->email,
                'ship_name'=>$ship->name,
                'ship_phone'=>$ship->phone,
                'ship_address'=>$ship->state,
                'ship_city'=>$ship->city,
                'ship_zip'=>$ship->zip,
                'order_number'=>$order->tracking_code,
                'coupon'=>$order->coupon,
                'coupon_value'=>$order->coupon_value,
                'cart_value'=>$order->cart_value,
                'tax'=>$order->tax,
                'shipping'=>$order->shipping_charge,
                'order_id'=>$order->tracking_code,
                'total'=>$order->total,
            
                'payment_type'=>$order->payment_type,
                'order_date'=>$order->created_at,
                 'hid'=>$order->tracking_code,
                  'msg'=>"Thank you for your order. Your order number $order->tracking_code has been placed.",
            
            ];
            
          
            
            
            $pdf = PDF::loadView('mail.orderstatus', $set);
               
               
               
                Mail::send('mail.order', $set, function($message)use($set, $pdf) {
                    $message->to($set['ship_email'])
                            ->subject("Thank you for your order. Your order number has been placed.")
                            ->attachData($pdf->output(), "orderinvoice.pdf");
                });
                   
              
                Mail::send('mail.order', $set, function($message)use($set, $pdf) {
                    $message->to($set['email'])
                            ->subject("Thank you for your order. Your order number has been placed.")
                            ->attachData($pdf->output(), "orderinvoice.pdf");
                });
            if($request->buynow==1){
              $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow',1)->delete();
            
            }else{
              $cart = DB::connection('mysql')->table('carts')->where('user_id',Auth::user()->id)->where('buynow','!=',1)->delete();
            
            
            }
            if (Session::has('coupon')) {
                Session::forget('coupon');
            
            }
            if (Session::has('vendorcoupon')) {
              Session::forget('vendorcoupon');
        
              }
              
              return redirect()->route('payment.success',['orderid'=>$order->tracking_code]);
              }
              else {
                if(Auth::check()){
  
                   return view('errors.paymentfailed');
                }else{
                   return redirect()->route('login');
             
                     }
              }
              
          } else {
            if(Auth::check()){
  
              return view('errors.paymentfailed');
            }else{
              return redirect()->route('login');
        
            }
          }
        }
}

