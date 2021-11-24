<?php
namespace App\Http\Controllers\Distributor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Distributor;
use File;
use Hash;
use App\Http\Traits\status;
use Str;

class AuthController extends Controller
{
    use status;
    public function login(){
        return view('distributor.login')->with('messege','error');
    }


    public function show(){
        return view('distributor.dashboard');
    }

    public function profile(){
        return view('distributor.profile.profile');
    }

    public function password(){
        return view('distributor.profile.password');
    }


    public function store(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
       if(!Auth::guard('distributor')->attempt($request->only('email','password'),$request->filled('remember'))){
           $notification=array(
              'messege'=>'Invalid username or password',
               'alert-type'=>'error'
           );

         return redirect()->route('distributor.logins')->with($notification);
       }
       // checking where user is block or not
       if(__getDist()->status!=1){
        Auth::logout();
        session()->flush();
        $notification=array(
            'messege'=>'You had been block.Please contact with administration',
             'alert-type'=>'error'
         );
         return redirect()->route('distributor.logins')->with($notification);

    }
          return redirect()->route('distributor.dashboard');
    }


    // update Distributor dealer profile detail 
    public function update(Request $request){//update profile of memeber

        try {

            $admin=Distributor::find(__getDist()->id);


            $file=$request->file('file');

            if($file){
                File::delete(__getDist()->profile_photo_path);
                $fname=rand().'distributor.'.$file->getClientOriginalExtension();
                $admin->profile_photo_path='upload/distributor/'.$fname;
                $path=$file->move(public_path().'/upload/distributor/',$fname);

            }
            $admin->email=$request->email;
            $admin->name=$request->name;
            $admin->state=$request->state;
            $admin->district=$request->district;
            $admin->city=$request->city;
            $admin->address=$request->address;
            $admin->city=$request->city;
            $admin->address=$request->address;
            $admin->pincode=$request->pincode;
            // $admin->adhar=$request->adhar;

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
                'messege'=>'Something went wrong.Please try again later',

             );
             return redirect()->back()->with($notification);

        }
        }

        // change Distributor dealer password
function changePassword(Request $request){
    $request->validate([
        'newpassword'=>'required|min:8|max:16',
        'confirmpassword'=>'required|min:8|max:16',

    ]);
    try {

        if(Hash::check($request->currentpassword, __getDist()->password)){
            if($request->newpassword===$request->confirmpassword){
                $admin=Distributor::find( __getDist()->id);
                $admin->password=Hash::make($request->newpassword);
                $admin->del=$request->newpassword;


$admin->save();
    Auth::logout();
   session()->flush();
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Password updated please login again !',

     );
     return redirect()->route('distributor.logins')->with($notification);

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
            'messege'=>'Something went wrong.Please try again later',

         );
         return redirect()->back()->with($notification);
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
            return redirect()->route('distributor.logins')->with($notification);
        } catch (\Throwable $th) {
            $notification=array(
                'alert-type'=>'info',
                'messege'=>'something went wrong please try again later !',

             );
            Auth::logout();
            return redirect()->back()->with($notification);;
        }

    }






//redirect to register page to register dealer
    public function  register(){
        return view('distributor.register');
    }










}
