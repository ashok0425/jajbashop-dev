<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Shipping_address;
use App\Models\User;
use App\Models\Ecommerce\Userkyc;
use Illuminate\Support\Facades\DB;
use File;
use Hash;
use session;

class AuthController extends Controller
{
    public function index(){
        return view('frontend.profile');
    }


    public function store(Request $request){ //login memeber
        $request->validate([
            'password'=>'required'
        ]);
        // try {
            //code...

            if(isset($request->userid)){
     $check=User::where('userid',$request->userid)->first();
      if($check){
     // $request->email=$check->email;
       if(!Auth::attempt($request->only('userid','password'),$request->filled('remember'))){

           $notification=array(
              'messege'=>'Invalid Credientials ',
               'alert-type'=>'error'
           );

         return redirect()->back()->with($notification);
       }
       if(Auth::user()->isactive!=1){
        Auth::logout();
        session()->flush();
        $notification=array(
            'messege'=>'You had been block.Please contact with administration',
             'alert-type'=>'error'
         );

       return redirect('/login')->with($notification);
    }
          return redirect()->route('profile');

    }else{
        $notification=array(
            'messege'=>'Invalid username or password',
             'alert-type'=>'error'
         );

       return redirect()->back()->with($notification);
    }
    if(isset($request->phone)){
        $check=User::where('userid',$request->phone)->first();
         if($check){
        // $request->email=$check->email;
          if(!Auth::attempt($request->only('phone','password'),$request->filled('remember'))){
   
              $notification=array(
                 'messege'=>'Invalid Credientials ',
                  'alert-type'=>'error'
              );
   
            return redirect()->back()->with($notification);
          }
          if(Auth::user()->isactive!=1){
           Auth::logout();
           session()->flush();
           $notification=array(
               'messege'=>'You had been block.Please contact with administration',
                'alert-type'=>'error'
            );
   
          return redirect('/login')->with($notification);
       }
             return redirect()->route('profile');
   
       }else{
           $notification=array(
               'messege'=>'Invalid username or password',
                'alert-type'=>'error'
            );
   
          return redirect()->back()->with($notification);
       }


// } catch (\Throwable $th) {
//     $notification=array(
//         'messege'=>'Something went wrong.Please try again later',
//          'alert-type'=>'error'
//      );

//    return redirect()->back()->with($notification);
// }
}
}

}










    public function loadData($load){
        if($load==1){
            $ship=Shipping_address::where('user_id',Auth::user()->id)->first();
            return view('frontend.ajaxload.profile.profile',compact('ship'));

        }
        if($load==2){
            return view('frontend.ajaxload.profile.password');

        }

        if($load==3){
            $wish = DB::table('wishlists')->join('products','wishlists.product_id','products.id')->select('wishlists.*','products.name','products.image','products.id as pid','products.price','products.short_desc')->where('wishlists.user_id',Auth::user()->id)->limit(4)->get();

            return view('frontend.ajaxload.profile.wishlist',compact('wish'));

        }

        if($load==4){
            $order = DB::table('orders')->where('user_id',Auth::user()->id)->limit(6)->get();

            return view('frontend.ajaxload.profile.order',compact('order'));

        }
        if($load==6){
            $order = DB::table('orders')->where('user_id',Auth::user()->id)->where('status',4)->limit(6)->get();

            return view('frontend.ajaxload.profile.order',compact('order'));

        }
        if($load==5){
            $order = DB::table('orders')->join('order_details','order_details.order_id','orders.order_id')->where('orders.user_id',Auth::user()->id)->where('order_details.status',6)->limit(6)->get();
            return view('frontend.ajaxload.profile.order',compact('order'));

        }
        if($load==7){
             
            $kyc=Userkyc::where('user_id',Auth::user()->id)->first();
            return view('frontend.ajaxload.profile.kyc',compact('kyc'));

        }
    }
  


public function update(Request $request){
try {
    $admin=User::find(Auth::user()->id);
    $admin->name=$request->name;
    $admin->email=$request->email;
    $admin->phone=$request->phone;
    
    $file=$request->file('file');
   
    if($file){
        
        File::delete(public_path($admin->profile_photo_path));
        $fname=rand().'user.'.$file->getClientOriginalExtension();
        $admin->profile_photo_path='upload/user/'.$fname;
        $path=$file->move(public_path().'/upload/user/',$fname);

    }
    
    if($admin->save()){
        
        $notification=array(
            'alert-type'=>'success',
            'messege'=>'Profile  updated',
           
         );
         return redirect()->back()->with($notification);
    }else{
        $notification=array(
            'alert-type'=>'info',
            'messege'=>'Profile  not updated',
           
         );
         return redirect()->back()->with($notification);
    }
    
   
} catch (\Throwable $th) {
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Something went wrong. Please try again later.',
        
     );
     return redirect()->back()->with($notification);

}
}


public function shippingupdate(Request $request){
    try {
        $admin=Shipping_address::where('user_id',Auth::user()->id)->first();
        if($admin){
            $admin->country=$request->country;
            $admin->state=$request->state;
            $admin->district=$request->district;
            $admin->city=$request->city;
            $admin->address=$request->address;
            $admin->pincode=$request->pincode;
             $admin->save();

        }else{
            $admin=new Shipping_address;
            $admin->country=$request->country;
            $admin->user_id=Auth::user()->id;
            $admin->state=$request->state;
            $admin->district=$request->district;
            $admin->city=$request->city;
            $admin->address=$request->address;
            $admin->pincode=$request->pincode;
             $admin->save();
        }
      
        
            
            $notification=array(
                'alert-type'=>'success',
                'messege'=>'Shipping Address  updated',
               
             );
             return redirect()->back()->with($notification);
        
             
       
    } catch (\Throwable $th) {
        $notification=array(
            'alert-type'=>'error',
            'messege'=>'Something went wrong. Please try again later.',
            
         );
         return redirect()->back()->with($notification);
    
    }
    }



function changePassword(Request $request){
    try {

        if(Hash::check($request->currentpassword, Auth::user()->password)){
            if($request->newpassword===$request->confirmpassword){
                $admin=User::find(Auth::user()->id);
                
                $admin->password=Hash::make($request->newpassword);
                
$admin->save();
    Auth::logout();
   session()->flush();
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Password updated please login again !',
         
     );
     return redirect()->route('login')->with($notification);

            }else{
                $notification=array(
                    'alert-type'=>'error',
                    'messege'=>'Password not match',
                     
                 );
                 return redirect()->back()->with($notification);
            }
              }else{
                $notification=array(
                    'alert-type'=>'error',
                    'messege'=>'Incorrect Password',
                   
                 );
                 return redirect()->back()->with($notification);
              }
    

    } catch (\Throwable $th) {
        $notification=array(
            'alert-type'=>'error',
            'messege'=>'Something went wrong .please try again later',
           
         );
         return redirect()->back()->with($notification);
    }
 
      
      }



    public function destory(){
        try {
            Auth::logout();
            session()->flush();
            $notification=array(
                'alert-type'=>'success',
                'messege'=>'successfully logout !',
                 
             );
          
            return redirect()->route('login')->with($notification);
        } catch (\Throwable $th) {
            $notification=array(
                'alert-type'=>'info',
                'messege'=>'something went wrong please try again later !',
                 
             );
            Auth::logout();
            return redirect()->back()->with($notification);;
        }
    
    }

 

}
