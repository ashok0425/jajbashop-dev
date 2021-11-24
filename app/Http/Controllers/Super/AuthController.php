<?php
namespace App\Http\Controllers\Super;
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
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    use status;
    public function login(){
        return view('super.login')->with('messege','error');
    }


    public function show(){
        return view('super.dashboard');
    }

    public function profile(){
        return view('super.profile.profile');
    }

    public function password(){
        return view('super.profile.password');
    }


    public function store(Request $request){

        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
       if(!Auth::guard('super')->attempt($request->only('email','password'),$request->filled('remember'))){

           $notification=array(
              'messege'=>'Invalid username or password',
               'alert-type'=>'error'
           );

         return redirect('/super/login')->with($notification);
       }
       // checking where user is block or not
       if(__getSuper()->status!=1){
        Auth::logout();
        session()->flush();
        $notification=array(
            'messege'=>'You had been block.Please contact with administration',
             'alert-type'=>'error'
         );

       return redirect('/super/login')->with($notification);
    }
          return redirect()->route('super.dashboard');
    }


    // update super dealer profile detail 
    public function update(Request $request){//update profile of memeber

        try {

            $admin=Super::find(__getSuper()->id);


            $file=$request->file('file');

            if($file){
                File::delete(__getSuper()->profile_photo_path);
                $fname=rand().'super.'.$file->getClientOriginalExtension();
                $admin->profile_photo_path='upload/super/'.$fname;
                $path=$file->move(public_path().'/upload/super/',$fname);

            }
            $admin->email=$request->email;
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

        // change super dealer password
function changePassword(Request $request){
    $request->validate([
        'newpassword'=>'required|min:8|max:16',
        'confirmpassword'=>'required|min:8|max:16',

    ]);
    try {

        if(Hash::check($request->currentpassword, __getSuper()->password)){
            if($request->newpassword===$request->confirmpassword){
                $admin=Super::find( __getSuper()->id);
                $admin->password=Hash::make($request->newpassword);
                $admin->del=$request->newpassword;


$admin->save();
    Auth::logout();
   session()->flush();
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Password updated please login again !',

     );
     return redirect()->route('super.logins')->with($notification);

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
            return redirect()->route('super.logins')->with($notification);
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
        return view('super.register');
    }


//store dealer register data
    public function  registerstore(Request $request){
    $request->validate([
      'name'=>'required',
      'email'=>'required|email|unique:distributors',
      'phone'=>'required|min:10|max:10|unique:distributors',
      'sponsor_email'=>'required',


  ]);
  if($request->adhar){
      $request->validate([
           'adhar'=>'required|min:12|max:12',
          ]);
  }

  try {
      //code...

      $check=Super::where('email',$request->sponsor_email)->first();
  if($check){

$phone=$request->phone;
$password=Str::substr($phone, 5, 5);
$user=new Distributor;
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
$user->sponsor_id=$check->id;

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

  }


  else{


      $notification=array(
          'alert-type'=>'error',
          'messege'=>'Invalid Sponsor Email',

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








}
