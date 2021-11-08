<?php
namespace App\Http\Controllers\Admin\Repurchase;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Super;
use App\Models\Distributor;
use File;
use Hash;
use App\Http\Traits\status;
use Str;
use App\Mail\Register;
use App\Models\Shipping;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class DistributorController extends Controller
{
    use status;
    public function index(){
        $super=Distributor::orderBy('id','desc')->get();
        return view('admin.repurchase.distributor.index',compact('super'));
    }

    public function pending(){
        $super=Distributor::where('status',2)->orderBy('id','desc')->get();
        return view('admin.repurchase.distributor.pending',compact('super'));
    }

    public function show($id){
        $super=Distributor::find($id);
        return view('admin.repurchase.distributor.show',compact('super'));
    }

   
    public function sales($id){
        $order=Order::where('seller_id',$id)->where('seller',2)->orderBy('id','desc')->get();
        $super=Distributor::find($id);
        return view('admin.repurchase.distributor.sales',compact('order','super'));
    }

    public function purchase($id){
        $order=Order::where('user_id',$id)->where('buyer',2)->orderBy('id','desc')->get();
        $super=Distributor::find($id);
        return view('admin.repurchase.distributor.purchase',compact('order','super'));
    }


    public function orderdetail($id,$orderId){
        $ship=Shipping::where('order_id',$id)->first();
        $product=DB::table('order_details')->join('orders','orders.id','order_details.order_id')->join('products','products.id','order_details.product_id')->join('categories','categories.id','products.category_id')->where('order_details.order_id',$id)->select('products.name','products.image','products.id as pid','categories.category','order_details.*')->orderBy('order_details.id','desc')->get();
       return view('admin.repurchase.distributor.ordershow',compact('product','ship','orderId','id'));
    }



    public function login(Request $request){ //login memeber
        try {
            //code...
            if(session()->has('dlogin')){
                Auth::guard('distributor')->logout();
                // dd($this->guard);
    
            }
            session()->put('dlogin',1);
       if(!Auth::guard('distributor')->attempt($request->only('email','password'),$request->filled('remember'))){
           $notification=array(
              'messege'=>'Invalid Credientials ',
               'alert-type'=>'error'
           );
           if(session()->has('dlogin')){
            Auth::guard('distributor')->logout();
            // dd($this->guard);
    
        }
         return redirect()->back()->with($notification);
       }
    
          return redirect()->route('distributor.dashboard');
    
    } catch (\Throwable $th) {
    $notification=array(
        'messege'=>'Something went wrong.Please try again later',
         'alert-type'=>'error'
     );
    
    return redirect()->back()->with($notification);
    }

    }


    public  function edit($id){

        $user=Distributor::where('id',$id)->first();
        return view('admin.repurchase.distributor.edit',compact('user'));

    }

// updating user data

public function update(Request $request){
    try {
        //code...

    $user=Distributor::find($request->id);
    if(isset($request->password) && $request->password!==''){

         $user->password=Hash::make($request->password);
         $user->del=$request->password;

    }
    $user->name=$request->name;
    $user->email=$request->email;
    $user->phone=$request->phone;
    $user->state=$request->state;
    $user->district=$request->district;
    $user->city=$request->city;
    $user->address=$request->address;
    $user->city=$request->city;
    $user->address=$request->address;
    $user->pincode=$request->pincode;
    $user->adhar=$request->adhar;

    if($user->save()){
        $notification=array(
            'messege'=>'Distributor Details updated',
             'alert-type'=>'success'
         );

        return redirect()->back()->with($notification);
    }
} catch (\Throwable $th) {
    $notification=array(
        'messege'=>'Something went wrong.Please try again later.',
         'alert-type'=>'error'
     );

    return redirect()->back()->with($notification);
}


}


//    loading pdf
public function print($id,$orderId){      
   
    try {
        $set=[
            'order_id'=>$id,
        ];
    $pdf = PDF::loadView('email.checkout', $set);
    return $pdf->download('invoice.pdf');
    } catch (\Throwable $th) {
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Something went wrong.Try again later',

    );
    return redirect()->back()->with($notification);
    }
    
    }




}
