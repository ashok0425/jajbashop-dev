<?php

namespace App\Http\Controllers\Admin\Repurchase;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use App\Models\Cart;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shipping;
use App\Models\Super;
use App\Models\Account;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use File;
class SaleController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;

    public function create()
    {
      $product=DB::connection('mysql2')->table('products')->join('categories','categories.id','products.category_id')->select('products.*','categories.category')->where('products.status',1)->where('products.repurchase',1)->orderBy('products.id','desc')->get();

       return view('admin.repurchase.sales.create',compact('product'));
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
    
      $sales = new Cart;
      $sales->product_id =$request->product_id ;
      $sales->qty = $request->sales_quantity;
      $sales->price = $request->price ;
      $sales->user_id = 0;
      $sales->buyer = 3;
      $sales->save();
      return 'success';
  }

//  sales cart item  using ajax
  public function saleslist(){
    $sales=DB::table('carts')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','carts.product_id')->select('alfacode_jajbashop_ecommerce.products.name','carts.*')->where('carts.buyer',3)->where('carts.user_id',0)->get();

      return view('admin.repurchase.sales.saleslist',compact('sales'));
  }

  // destroy sales cart item 
  public function destroy($id){
      DB::table('carts')->where('id',$id)->where('buyer',3)->where('user_id',0)->delete();
      return response()->json('Item Deleted');

  }



// storing all the data after checkout
public function checkout(Request $request){
  $request->validate([
      'payment_mode'=>'required',

   ]);
  
  $superD=DB::table('supers')->where('email',$request->email)->where('phone',$request->phone)->first();
  if(!$superD){
    $notification=array(
      'alert-type'=>'error',
      'messege'=>'Super Distributor not find',

   );
  return redirect()->back()->with($notification);
  }

  // try {
      //code...
      $id=$superD->id;
      $prId=Order::orderBy('id','desc')->value('id');
      $orderId=rand().$prId;
      $id=$superD->id;
      $payment_mode=$request->payment_mode;
      $seller=4;
      $buyer=3;
      $seller_id=0;
      $buyer_id=$id;
      $ship=$superD;

      $sale=DB::table('carts')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','carts.product_id')->select('carts.*','alfacode_jajbashop_ecommerce.products.sc','alfacode_jajbashop_ecommerce.products.bv','alfacode_jajbashop_ecommerce.products.hsn_id')->where('carts.buyer',3)->where('carts.user_id',0)->get();

  $total=0;
  $bv=0;
  $comission=0;
  foreach($sale as $item){
      $total+=$item->qty*$item->price;
      $bv+=$item->qty*$item->bv;
      $comission+=(($item->price*$item->sc)/100)*$item->qty;
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
 

    // pushing order 
    $this->orderPush($orderId,$total,$comission,$bv,$payment_mode,$sale,$buyer,$seller,$seller_id,$buyer_id,$ship);
  // deletecart item 
    DB::table('carts')->where('user_id',0)->where('buyer',3)->delete();

// printing invoice on sale 
  return view('admin.repurchase.sales.invoice',compact('orderId'));
// } catch (\Throwable $th) {

//   $notification=array(
//       'alert-type'=>'error',
//       'messege'=>'Something went wrong.Please try again later',

//    );
//   return redirect()->back()->with($notification);
// }

}




}