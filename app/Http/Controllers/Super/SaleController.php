<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use Illuminate\Support\Facades\DB;
use App\Models\Salescart;
use App\Models\Inventory;
use App\Models\Distributor;
use App\Models\Account;
use App\Models\Order;
class SaleController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;



    public function create()
    {
        $product=DB::table('inventories')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','inventories.product_id')->select('alfacode_jajbashop_ecommerce.products.*')->where('inventories.buyer',3)->where('inventories.user_id',__getSuper()->id)->select('alfacode_jajbashop_ecommerce.products.name','alfacode_jajbashop_ecommerce.products.image','alfacode_jajbashop_ecommerce.products.id as pid','inventories.*')->orderBy('inventories.id','desc')->get();
       return view('super.sales.create',compact('product'));
    }

// Stroing  product  using ajax like qty and price from inventory
    public function getData($pid){
        $product=DB::table('inventories')->where('buyer',3)->where('user_id',__getSuper()->id)->where('id',$pid)->first();
      return response()->json($product);
    }

// Stroing  sales cart item using ajax
    public function store(Request $request){
        $request->validate([
            'product_id'=>'required',
            'sales_quantity'=>'required',
            'price'=>'required',
        ]);
        $product=Inventory::where('id',$request->product_id)->first();
        $sales = new Salescart;
        $sales->product_id =$product->product_id ;
        $sales->qty = $request->sales_quantity;
        $sales->price = $product->price ;
        $sales->user_id = __getSuper()->id;
        $sales->seller = 3;
        $sales->save();
        return 'success';
    }

//  sales cart item  using ajax
    public function saleslist(){
        $sales=DB::table('salescarts')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','salescarts.product_id')->select('alfacode_jajbashop_ecommerce.products.name','salescarts.*')->where('salescarts.seller',3)->where('salescarts.user_id',__getSuper()->id)->get();
        return view('super.sales.saleslist',compact('sales'));
    }

    // destroy sales cart item 
    public function destroy($id){
        DB::table('salescarts')->where('id',$id)->where('seller',3)->where('user_id',__getSuper()->id)->delete();

        return response()->json('Item Deleted');

    }



  
   

// storing all the data after checkout
public function checkout(Request $request){
    $request->validate([
        'payment_mode'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
     ]);
    //  checking whether the distributor is available or not
    $check=Distributor::where('email',$request->email)->where('phone',$request->phone)->first();
    if(!$check){
  $notification=array(
      'alert-type'=>'error',
      'messege'=>'Sorry,No  distributor find with this email or phone',

   );
  return redirect()->back()->with($notification);
    }
    // try {

// making order id for next order id 
    $prId=Order::orderBy('id','desc')->value('id');
    $orderId=rand().$prId;
    $id=$check->id;
    $payment_mode=$request->payment_mode;
    $seller=3;
    $buyer=2;
    $seller_id=__getSuper()->id;
    $buyer_id=$id;
    $ship=$check;

        //code...
        $sale=DB::table('salescarts')->join('alfacode_jajbashop_ecommerce.products','alfacode_jajbashop_ecommerce.products.id','salescarts.product_id')->select('salescarts.*','alfacode_jajbashop_ecommerce.products.dc','alfacode_jajbashop_ecommerce.products.bv','alfacode_jajbashop_ecommerce.products.hsn_id')->where('salescarts.seller',3)->where('salescarts.user_id',__getSuper()->id)->get();
        if(count($sale)<=0){
            $notification=array(
              'alert-type'=>'error',
              'messege'=>'Cart is empty',
          
           );}
    $total=0;
    $bv=0;
    $comission=0;
    foreach($sale as $item){
        $total+=$item->qty*$item->price;
        $bv+=$item->qty*$item->bv;
        $comission+=(($item->price*$item->dc)/100)*$item->qty;


    }
   //  Checking Payment mode in order to deduct amount if its is from account fund
   $account=Account::where('user_id',$id)->where('user_type',2)->first();
   if($request->payment_mode=='account'){
    if(!$account||$account->amount<$total){
      $notification=array(
         'alert-type'=>'error',
         'messege'=>'Insuffiecent balance in Account.',
     
      );
     return redirect()->back()->with($notification);
    }else{
        // deducating amount from distributor acccount 
      $account->amount=$account->amount-$total;
      $account->save();
      
    // Adding amount from distributor acccount to super distributor account
      $superaccount=Account::where('user_id',__getSuper()->id)->where('user_type',3)->first();
       $superaccount->amount=$superaccount->amount+$total;
       $superaccount->save();


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
   
  $this->orderPush($orderId,$total,$comission,$bv,$payment_mode,$sale,$buyer,$seller,$seller_id,$buyer_id,$ship);
    
  DB::table('salescarts')->where('salescarts.user_id',__getSuper()->id)->where('seller',3)->delete();
  
// printing invoice on sale 
return view('super.sales.invoice',compact('orderId'));

// } catch (\Throwable $th) {

//     $notification=array(
//         'alert-type'=>'error',
//         'messege'=>'Something went wrong.Please try again later',

//      );
//     return redirect()->back()->with($notification);
// }

}





}
