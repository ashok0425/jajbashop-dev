<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shipping;
use App\Models\Account;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use File;
class PurchaseController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;

    public function create()
    {
      $product=DB::table('products')->join('categories','categories.id','products.category_id')->select('products.*','categories.category')->orderBy('products.id','desc')->get();
       return view('distributor.purchase..create',compact('product'));
    }

    // Stroing  product  using ajax like qty and price from inventory

    public function getData($pid){
      $product=DB::table('products')->where('id',$pid)->first();

    return response()->json($product);
  }

// Stroing  sales cart item using ajax
  public function store(Request $request){
      $request->validate([
          'product_id'=>'required',
          'sales_quantity'=>'required',
          'price'=>'required',

      ]);
    
      $sales = new Cart;
      $sales->product_id =$request->product_id ;
      $sales->qty = $request->sales_quantity;
      $sales->price = $request->price ;
      $sales->user_id = __getDist()->id;
      $sales->buyer = 2;
      $sales->save();
      return 'success';
  }

//  sales cart item  using ajax
  public function saleslist(){
      $sales=DB::table('carts')->join('products','products.id','carts.product_id')->select('products.name','carts.*')->where('carts.buyer',2)->where('carts.user_id',__getDist()->id)->get();
      return view('distributor.purchase.saleslist',compact('sales'));
  }

  // destroy sales cart item 
  public function destroy($id){
      DB::table('carts')->where('id',$id)->where('buyer',2)->where('user_id',__getDist()->id)->delete();

      return response()->json('Item Deleted');

  }



/// storing all the data after checkout
public function checkout(Request $request){
  $request->validate([
      'payment_mode'=>'required',
      'super'=>'required',


   ]);
 
  
  $id=__getDist()->id;
  try {
      //code...
      $sale=DB::table('carts')->join('products','products.id','carts.product_id')->select('carts.*','products.dc','products.bv')->where('carts.buyer',2)->where('carts.user_id',__getDist()->id)->get();
  $total=0;
  $bv=0;
  $comission=0;
  foreach($sale as $item){
      $total+=$item->qty*$item->price;
      $bv+=$item->qty*$item->bv;
      $comission+=(($item->price*$item->dc)/100)*$item->qty;


  }
 //  Checking Payment mode in order to deduct amount if its is from account fund
 $account=Account::where('user_id',$id)->where('user_type',3)->first();
 if($request->payment_mode=='account'){
  if(!$account||$account->amount<$total){
    $notification=array(
       'alert-type'=>'error',
       'messege'=>'Insuffiecent balance in Account.',
   
    );
   return redirect()->back()->with($notification);
  }else{
    $account->amount=$account->amount-$total;
    $account->save();

  }
 }

  //storing or updating commsion amount 
  $account=Account::where('user_id',$id)->where('user_type',2)->first();
  if($account){
          $account->amount=$account->amount+$comission;
          $account->save();
  }else{
        $account=new Account;
        $account->amount=$comission;
        $account->user_id=$id;
        $account->user_type=2;
        $account->save();
  }
  $order=new Order;
  $order->user_id=$id;
  $order->seller_id=$request->super;
  $order->total=$total;
  $order->bv=$bv;
  $order->comission=$comission;
  $order->payment_mode=$request->payment_mode;
  $order->payment_id=rand();
  $order->order_id='JS'.uniqid();
  $order->buyer=2;
  $order->seller=3;
  if($order->save()){
    $ship=new Shipping;
    $ship->name=__getDist()->name;
    $ship->email=__getDist()->email;
    $ship->phone=__getDist()->phone;
    $ship->state=__getDist()->state;
    $ship->district=__getDist()->district;
    $ship->city=__getDist()->city;
    $ship->pincode=__getDist()->pincode;
    $ship->order_id=$order->id;
     $ship->save();
  //   storing cart item
 foreach ($sale as  $item) {
    $orderdetail=new Order_detail;
    $orderdetail->order_id=$order->id;
    $orderdetail->product_id=$item->product_id;
    $orderdetail->price=$item->price;
    $orderdetail->qty=$item->qty;
    $orderdetail->bv=$item->bv;
    $orderdetail->comission=$item->dc;
    $orderdetail->save();

   }

 //    updating inventory of login user
 $datas=array();
 
//    storing all cart item to inventory
 foreach ($sale as $item) {
     $check=Inventory::where('user_id',$id)->where('product_id',$item->product_id)->where('buyer',2)->first();
     if($check){
    $inventory=Inventory::find($check->id);
     $inventory->qty=$item->qty+$check->qty;
     $inventory->price=$item->price;
     $inventory->bv=$item->bv;
     $inventory->save();
     }else{
      $inventory=new Inventory;
      $inventory->user_id=$id;
      $inventory->qty=$item->qty;
      $inventory->price=$item->price;
      $inventory->product_id=$item->product_id;
      $inventory->buyer=2;
      $inventory->seller=3;
      $inventory->bv=$item->bv;
      $inventory->save();
     }
 }
//    loading pdf
 $set=[
  'order_id'=>$order->id,
  'email'=>$ship->email,
  'orderId'=>$order->order_id,
  'date'=>$order->created_at,



];
 $pdf = PDF::loadView('email.checkout', $set);
 $sale=DB::table('salescarts')->where('user_id',__getDist()->id)->where('seller',3)->delete();


// sending email
 Mail::send('email.order', $set, function($message)use($set, $pdf) {
     $message->to($set['email'])
             ->subject("Thank you for your order. Your order number has been placed.")
             ->attachData($pdf->output(), "orderinvoice.pdf");
 });

 $notification=array(
  'alert-type'=>'success',
  'messege'=>' Buy Sucessfully.',

);
return redirect()->back()->with($notification);
  }

} catch (\Throwable $th) {

  $notification=array(
      'alert-type'=>'error',
      'messege'=>'Something went wrong.Please try again later',

   );
  return redirect()->back()->with($notification);
}

}


}