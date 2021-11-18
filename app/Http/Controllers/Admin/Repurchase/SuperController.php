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

class SuperController extends Controller
{
    use status;
    public function index(){
        $super=Super::orderBy('id','desc')->get();
        return view('admin.repurchase.super.index',compact('super'));
    }


    public function show($id){
        $super=Super::find($id);
        return view('admin.repurchase.super.show',compact('super'));
    }

    public function distributor($id){
        $dist=Distributor::where('sponsor_id',$id)->orderBy('id','desc')->get();
        $super=Super::find($id);
        return view('admin.repurchase.super.distributor',compact('dist','super'));
    }

    public function sales($id){
        $order=Order::where('seller_id',$id)->where('seller',3)->orderBy('id','desc')->get();
        $super=Super::find($id);
        return view('admin.repurchase.super.sales',compact('order','super'));
    }

    public function purchase($id){
        $order=Order::where('user_id',$id)->where('buyer',3)->orderBy('id','desc')->get();
        $super=Super::find($id);
        return view('admin.repurchase.super.purchase',compact('order','super'));
    }


    public function orderdetail($id,$orderId){
        $ship=Shipping::where('order_id',$id)->first();
        $product=DB::table('order_details')->join('orders','orders.id','order_details.order_id')->join('jajbashop_ecommerce.products','jajbashop_ecommerce.products.id','order_details.product_id')->where('order_details.order_id',$id)->select('jajbashop_ecommerce.products.name','jajbashop_ecommerce.products.image','jajbashop_ecommerce.products.id as pid','order_details.*')->orderBy('order_details.id','desc')->get();
       return view('admin.repurchase.super.ordershow',compact('product','ship','orderId','id'));
    }



    public function login(Request $request){ //login memeber

        try {
            //code...
            if(session()->has('slogin')){
                Auth::guard('super')->logout();
                // dd($this->guard);
    
            }
            session()->put('slogin',1);
       if(!Auth::guard('super')->attempt($request->only('email','password'),$request->filled('remember'))){
           $notification=array(
              'messege'=>'Invalid Credientials ',
               'alert-type'=>'error'
           );
           if(session()->has('slogin')){
            Auth::guard('super')->logout();
            // dd($this->guard);
    
        }
         return redirect()->back()->with($notification);
       }
    
          return redirect()->route('super.dashboard');
    
    } catch (\Throwable $th) {
    $notification=array(
        'messege'=>'Something went wrong.Please try again later',
         'alert-type'=>'error'
     );
    
    return redirect()->back()->with($notification);
    }

    }


    public  function edit($id){

        $user=Super::where('id',$id)->first();
        return view('admin.repurchase.super.edit',compact('user'));

    }

// updating user data

public function update(Request $request){
    try {
        //code...

    $user=Super::find($request->id);
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
            'messege'=>'User Details updated',
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
public function download($id,$orderId){      
   
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



//redirect to register page to register dealer
public function  create(){
    return view('admin.repurchase.super.create');
}


//store dealer register data
public function  store(Request $request){
$request->validate([
  'name'=>'required',
  'email'=>'required|email|unique:supers',
  'phone'=>'required|min:10|max:10|unique:supers',
  'adhar'=>'required|min:12|max:12',
  'state'=>'required',
  'district'=>'required',
  'city'=>'required',
  'address'=>'required',
  'pincode'=>'required',



]);


try {
  //code...

$phone=$request->phone;
$password=Str::substr($phone, 5, 5);
$user=new Super;
$user->name=$request->name;
$user->phone=$request->phone;
$user->adhar=$request->adhar;
$user->email=$request->email;
$user->state=$request->state;
$user->district=$request->district;
$user->city=$request->city;
$user->address=$request->address;
$user->pincode=$request->pincode;
$user->password=Hash::make($password);
$user->del=$password;

if($user->save()){
$data=[
'name'=>$request->name,
'username'=>$request->email,
'password'=>$password,
];
Mail::to($request->email)->send(new Register($data));
session()->flash('register','Registration Complete.Email: '.$request->email .' and Password: '. $password );
$notification=array(
'alert-type'=>'success',
'messege'=>'Registration Successfull',

);
return redirect()->back()->with($notification);;
}

} catch (\Throwable $th) {
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Something Went wrong.Please try again later.',

     );
    return redirect()->back()->with($notification);;

}
}

// printing order 

public function print($id){
$orderId=$id;
return view('admin.repurchase.super.print',compact('orderId'));
}

}
