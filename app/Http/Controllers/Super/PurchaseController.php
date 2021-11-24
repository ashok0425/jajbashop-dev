<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Account;
use App\Models\Ecommerce\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class PurchaseController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;

    public function create()
    {
      $product=DB::connection('mysql2')->table('products')->join('categories','categories.id','products.category_id')->select('products.*','categories.category')->where('products.status',1)->where('products.repurchase',1)->orderBy('products.id','desc')->get();
       return view('super.purchase.create',compact('product'));
    }

    // Stroing  product  using ajax like qty and price from inventory

    public function getData($pid){
      $product=DB::connection('mysql2')->table('products')->where('id',$pid)->first();

    return response()->json($product);
  }

// Stroing  sales cart item using ajax
  public function store(Request $request){
      $request->validate([
          'product_id'=>'required',
          'sales_quantity'=>'required',
          'price'=>'required',

      ]);
    $price=Product::find($request->product_id);
      $sales = new Cart;
      $sales->product_id =$request->product_id ;
      $sales->qty = $request->sales_quantity;
      $sales->price = $price->offer_price ;
      $sales->user_id = __getSuper()->id;
      $sales->buyer = 3;
      $sales->save();
      return 'success';
  }

//  sales cart item  using ajax
  public function saleslist(){
      $sales=DB::table('carts')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','carts.product_id')->select('alfacode_jajbashop_ecommerce.products.name','carts.*')->where('carts.buyer',3)->where('carts.user_id',__getSuper()->id)->get();
 
      return view('super.purchase.saleslist',compact('sales'));
  }

  // destroy sales cart item 
  public function destroy($id){
      DB::table('carts')->where('id',$id)->where('buyer',3)->where('user_id',__getSuper()->id)->delete();
      return response()->json('Item Deleted');

  }



// storing all the data after checkout
public function checkout(Request $request){
  $request->validate([
      'payment_mode'=>'required',

   ]);
 
  
  // try {
// making order id for next order id 
    $prId=Order::orderBy('id','desc')->value('id');
    $orderId=rand().$prId;
    $id=__getSuper()->id;
    $payment_mode=$request->payment_mode;
    $seller=4;
    $buyer=3;
    $seller_id=0;
    $buyer_id=$id;
    $ship=__getSuper();
      //code...
      $sale=DB::table('carts')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','carts.product_id')->select('carts.*','alfacode_jajbashop_ecommerce.products.sc','alfacode_jajbashop_ecommerce.products.bv','alfacode_jajbashop_ecommerce.products.hsn_id')->where('carts.buyer',3)->where('carts.user_id',__getSuper()->id)->get();

      if(count($sale)<=0){
        $notification=array(
          'alert-type'=>'error',
          'messege'=>'Cart is empty',
      
       );
      return redirect()->back()->with($notification);
      }
  $total=0;
  $bv=0;
  $comission=0;
  foreach($sale as $item){
      $total+=$item->qty*$item->price;
      $bv+=$item->qty*$item->bv;
      $comission+=(($item->price*$item->sc)/100)*$item->qty;
  }



// checking if payment mode is paytm 
if($payment_mode=='paytm'){
  $data = [
    'order_id' => $orderId,
    'amount' => $total,
   'payment_mode' =>$payment_mode,
    'seller'=>$seller,
    'buyer'=>$buyer,
    'seller_id'=>$seller_id,
    'buyer_id'=>$buyer_id,
    'ship'=>$ship,
    'comission'=>$comission,
    'bv'=>$bv,
    'sale'=>$sale,



  ];
  $response = Cookie::make('jajbashop',json_encode($data),5);
  return redirect()->route('super.paytm')->withCookie($response);
}




 //  Checking Payment mode in order to deduct amount if its is from account fund
 $account=Account::where('user_id',$id)->where('user_type',3)->first();
 if($payment_mode=='account'){
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
  $account=Account::where('user_id',$id)->where('user_type',3)->first();
  if($account){
          $account->amount=$account->amount+$comission;
          $account->save();
  }else{
        $account=new Account;
        $account->amount=$comission;
        $account->user_id=$id;
        $account->user_type=3;
        $account->save();
  }

  // calling orderpush method in order to store order into database from status trait
  $this->orderPush($orderId,$total,$comission,$bv,$payment_mode,$sale,$buyer,$seller,$seller_id,$buyer_id,$ship);
  DB::table('carts')->where('carts.user_id',__getSuper()->id)->where('buyer',3)->delete();
  
// printing invoice on sale 
return view('super.purchase.invoice',compact('orderId'));
// } catch (\Throwable $th) {

//   $notification=array(
//       'alert-type'=>'error',
//       'messege'=>'Something went wrong.Please try again later',

//    );
//   return redirect()->back()->with($notification);
// }







}


}