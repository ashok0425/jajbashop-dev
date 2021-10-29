<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\status;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Salescart;
use App\Models\Inventory;
use App\Models\Distributor;
use App\Models\Account;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Shipping;
use Illuminate\Support\Facades\Mail;
class SaleController extends Controller
{

// Note :: active,deactive,destroy,method are place in Traits/status file


    use status;

    public function index()
    {
        $product=DB::table('inventories')->leftjoin('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','inventories.product_id')->join('jajbashop_ecommerce.categories','jajbashop_ecommerce.categories.id','jajbashop_ecommerce.products.category_id')->select('jajbashop_ecommerce.products.*','jajbashop_ecommerce.categories.category')->where('inventories.buyer',3)->where('inventories.user_id',__getSuper()->id)->select('jajbashop_ecommerce.products.name','jajbashop_ecommerce.products.image','jajbashop_ecommerce.products.id as pid','jajbashop_ecommerce.categories.category','inventories.*')->orderBy('inventories.id','desc')->get();
       return view('super.inventory.index',compact('product'));
    }

    public function create()
    {
        $product=DB::table('inventories')->leftjoin('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','inventories.product_id')->join('jajbashop_ecommerce.categories','jajbashop_ecommerce.categories.id','jajbashop_ecommerce.products.category_id')->select('jajbashop_ecommerce.products.*','jajbashop_ecommerce.categories.category')->where('inventories.buyer',3)->where('inventories.user_id',__getSuper()->id)->select('jajbashop_ecommerce.products.name','jajbashop_ecommerce.products.image','jajbashop_ecommerce.products.id as pid','jajbashop_ecommerce.categories.category','inventories.*')->orderBy('inventories.id','desc')->get();
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
        $product_id=Inventory::where('id',$request->product_id)->value('product_id');
        $sales = new Salescart;
        $sales->product_id =$product_id ;
        $sales->qty = $request->sales_quantity;
        $sales->price = $request->price ;
        $sales->user_id = __getSuper()->id;
        $sales->seller = 3;
        $sales->save();
        return 'success';
    }

//  sales cart item  using ajax
    public function saleslist(){
        $sales=DB::table('salescarts')->join('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','salescarts.product_id')->select('jajbashop_ecommerce.products.name','salescarts.*')->where('salescarts.seller',3)->where('salescarts.user_id',__getSuper()->id)->get();
        return view('super.sales.saleslist',compact('sales'));
    }

    // destroy sales cart item 
    public function destroy($id){
        DB::table('salescarts')->where('id',$id)->where('seller',3)->where('user_id',__getSuper()->id)->delete();

        return response()->json('Item Deleted');

    }



    public function order()
    {
        $product=DB::table('orders')->where('seller',3)->where('seller_id',__getSuper()->id)->where('status',0)->get();
       return view('super.sales.pending',compact('product'));
    }

    
    public function acceptorder($id)
    {
        $product=DB::table('orders')->where('seller',3)->where('seller_id',__getSuper()->id)->where('id',$id)->update(['status'=>1]);
        $notification=array(
            'alert-type'=>'success',
            'messege'=>'Order Accepted',
        
         );
       return redirect()->route('super.sale.order')->with($notification);
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
    $id=$check->id;
    // try {
        //code...
        $sale=DB::table('salescarts')->join('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','salescarts.product_id')->select('salescarts.*','jajbashop_ecommerce.products.dc','jajbashop_ecommerce.products.bv')->where('salescarts.seller',3)->where('salescarts.user_id',__getSuper()->id)->get();
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
    $order=new Order;
    $order->user_id=$id;
    $order->seller_id=__getSuper()->id;
    $order->total=$total;
    $order->bv=$bv;
    $order->comission=$comission;
    $order->payment_mode=$request->payment_mode;
    $order->payment_id=rand();
    $order->order_id='JS'.uniqid();
    $order->buyer=2;
    $order->status=4;
    $order->seller=3;
    if($order->save()){
      $ship=new Shipping;
      $ship->name=$check->name;
      $ship->email=$check->email;
      $ship->phone=$check->phone;
      $ship->state=$check->state;
      $ship->district=$check->district;
      $ship->city=$check->city;
      $ship->pincode=$check->pincode;
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
   foreach ($sale as $item) {
    $check=DB::table('inventories')->where('user_id',__getSuper()->id)->where('product_id',$item->product_id)->where('buyer',3)->first();
    $inventory=Inventory::find($check->id);
    $inventory->qty=$inventory->qty-$item->qty;
    $inventory->save();
   $datas[]=$inventory;
    }
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
   $sale=DB::table('salescarts')->where('user_id',__getSuper()->id)->where('seller',3)->delete();
   $notification=array(
    'alert-type'=>'success',
    'messege'=>' Sold Sucessfully.',

 );
   return redirect()->back()->with($notification);

   $pdf = PDF::loadView('email.checkout', $set);

// sending email
   Mail::send('email.order', $set, function($message)use($set, $pdf) {
       $message->to($set['email'])
               ->subject("Thank you for your order. Your order number has been placed.")
               ->attachData($pdf->output(), "orderinvoice.pdf");
   });

   $notification=array(
    'alert-type'=>'success',
    'messege'=>' Sold Sucessfully.',

 );
return redirect()->back()->with($notification);
    }

// } catch (\Throwable $th) {

//     $notification=array(
//         'alert-type'=>'error',
//         'messege'=>'Something went wrong.Please try again later',

//      );
//     return redirect()->back()->with($notification);
// }

}





}
