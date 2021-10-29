<?php
namespace App\Http\Controllers\Vendorpanel;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Vendor;
use File;
use Hash;
use session;
class AuthController extends Controller
{
    public function index(){

    return view('vendorpanel.register');
    }



    public function show(){
        return view('vendorpanel.dashboard');
    }


    public function editpassword(){
        return view('vendorpanel.password');
    }

    public function profile(){
        return view('vendorpanel.profile');
    }


public function update(Request $request){

// try {
 
    $admin=User::find(Auth::user()->id);
    
    
    $file=$request->file('file');
   
    if($file){
        File::delete(public_path($admin->profile_photo_path));
        $fname=rand().'vendor.'.$file->getClientOriginalExtension();
        $admin->profile_photo_path='upload/vendor/'.$fname;
        $file->move(public_path().'/upload/vendor/',$fname);

    }
    // $admin->email=$request->email;
    $admin->name=$request->name;
    $admin->company_state=$request->company_state;
    $admin->display_name=$request->display_name;
    $admin->company_address=$request->company_address;
    $admin->company_name=$request->company_name;
    $admin->company_pan=$request->company_pan;
    $admin->company_pincode=$request->company_pincode;
    $admin->company_gst=$request->company_gst;
    $admin->fssai=$request->fssai;
    $admin->company_city=$request->company_city;
    $admin->house_no=$request->house_no;
    $admin->flat_no=$request->flat_no;
    $admin->road_no=$request->road_no;

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
    
   
// } catch (\Throwable $th) {
//     $notification=array(
//         'alert-type'=>'error',
//         'messege'=>'Something went wrong. Please try again later.',
        
//      );
//      return redirect()->back()->with($notification);

// }
}


function changePassword(Request $request){
    $request->validate([
        'newpassword'=>'required|min:8|max:16',
        'confirmpassword'=>'required|min:8|max:16',

    ]);
    try {

        if(Hash::check($request->currentpassword, Auth::user()->password)){
            if($request->newpassword===$request->confirmpassword){
                $admin=User::find( Auth::user()->id);
                $admin->password=Hash::make($request->newpassword);
                
$admin->save();
    Auth::logout();
   session()->flush();
    $notification=array(
        'alert-type'=>'success',
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
                    'messege'=>'Inccorect Password',
                   
                 );
                 return redirect()->back()->with($notification);
              }
    

    } catch (\Throwable $th) {
        $notification=array(
            'alert-type'=>'info',
            'messege'=>'something went wrong please try again later !',
             
         );
        return redirect()->back()->with($notification);;
    }
 
      
      }






    public function destory(){
        try {
            $notification=array(
                'alert-type'=>'success',
                'messege'=>'successfully logout !',
                 
             );
            Auth::logout();
         session()->flush();
            return redirect()->route('vendor.logins')->with($notification);
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
