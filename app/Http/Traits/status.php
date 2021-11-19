<?php
namespace App\Http\Traits;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\Order_detail;
use App\Models\Shipping;
use File;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
trait status
{
   /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function active($id,$table){
        DB::table($table)->where('id',$id)->update([
             'status'=>1,
         ]);
         $notification=array(
             'alert-type'=>'info',
             'messege'=>'Status Activated',

          );
          return redirect()->back()->with($notification);
     }

     protected function deactive($id,$table){
        DB::table($table)->where('id',$id)->update([
            'status'=>0,
        ]);
        $notification=array(
            'alert-type'=>'info',
            'messege'=>'Status Deactivated',

         );
         return redirect()->back()->with($notification);
    }


    protected function destroy($id,$table){
      $image=DB::table($table)->where('id',$id)->value('image');
      if($image){
          File::delete($image);
      }
      DB::table($table)->where('id',$id)->delete();

        $notification=array(
            'alert-type'=>'success',
            'messege'=>'Sucessfull deleted',

         );
         return redirect()->back()->with($notification);
    }



    public function orderPush($orderId,$total,$comission,$bv,$payment_mode,$sale,$buyer,$seller,$seller_id,$buyer_id,$ship){
        $order=new Order;
        $order->user_id=$buyer_id;
        $order->seller_id=$seller_id;
        $order->total=$total;
        $order->bv=$bv;
        $order->comission=$comission;
        $order->payment_mode=$payment_mode;
        $order->payment_id=rand();
        $order->order_id=$orderId;
        $order->buyer=$buyer;
        $order->seller=$seller;
        if($order->save()){
          $shiping=new Shipping;
          $shiping->name=$ship->name;
          $shiping->email=$ship->email;
          $shiping->phone=$ship->phone;
          $shiping->state=$ship->state;
          $shiping->district=$ship->district;
          $shiping->city=$ship->city;
          $shiping->pincode=$ship->pincode;
          $shiping->order_id=$order->id;
           $shiping->save();
        //   storing cart item
       foreach ($sale as  $item) {
$gst=DB::connection('mysql2')->table('gsts')->where('id',$item->hsn_id)->value('percent');
          $orderdetail=new Order_detail;
          $orderdetail->order_id=$order->id;
          $orderdetail->product_id=$item->product_id;
          $orderdetail->price=$item->price;
          $orderdetail->qty=$item->qty;
          $orderdetail->bv=$item->bv;
          $orderdetail->gst=$gst;

          if ($seller==4) {
            $orderdetail->comission=(($item->price*$item->sc)/100)*$item->qty;

          }elseif($seller==3){
          $orderdetail->comission=(($item->price*$item->dc)/100)*$item->qty;

          }else{

          }
          $orderdetail->save();
         }
      
       
       
      //    storing all cart item to inventory
       foreach ($sale as $item) {
           $check=Inventory::where('user_id',$buyer_id)->where('product_id',$item->product_id)->where('buyer',$buyer)->first();
           if($check){
          $inventory=Inventory::find($check->id);
           $inventory->qty=$item->qty+$check->qty;
           $inventory->price=$item->price;
           $inventory->save();
           }else{
            $inventory=new Inventory;
            $inventory->user_id=$buyer_id;
            $inventory->qty=$item->qty;
            $inventory->price=$item->price;
            $inventory->product_id=$item->product_id;
            $inventory->buyer=$buyer;
            $inventory->seller=$seller;
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
      
      //  $pdf = PDF::loadView('email.checkout', $set);
      //  $sale=DB::table('salescarts')->where('user_id',__getSuper()->id)->where('seller',3)->delete();
         
      // // sending email
      //  Mail::send('email.order', $set, function($message)use($set, $pdf) {
      //      $message->to($set['email'])
      //              ->subject("Thank you for your order. Your order number has been placed.")
      //              ->attachData($pdf->output(), "orderinvoice.pdf");
      //  });
      
        }
      
        
      }

}
