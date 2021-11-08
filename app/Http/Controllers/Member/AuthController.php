<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Level;
use Str;
use File;
use Illuminate\Support\Facades\Hash;
use session;
use Illuminate\Support\Facades\DB;
use App\Mail\Register;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{
    public function login(){ //login page
        return view('member.login')->with('messege','error');
    }


    public function show(){ //redirect after login to dasboard page
        return view('member.dashboard');
    }

    public function profile(){ //profile page
        return view('member.profile.profile');
    }

    public function password(){ //change passs c[page]
        return view('member.profile.password');
    }


public function update(Request $request){//update profile of memeber

try {

    $admin=User::find(Auth::user()->id);


    $file=$request->file('file');

    if($file){
        File::delete(Auth::user()->profile_photo_path);
        $fname=rand().'admin.'.$file->getClientOriginalExtension();
        $admin->profile_photo_path='upload/admin/'.$fname;
        $path=$file->move(public_path().'/upload/admin/',$fname);

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



function changePassword(Request $request){//update password of memeber
    $request->validate([
        'newpassword'=>'required|min:8|max:16',
        'confirmpassword'=>'required|min:8|max:16',

    ]);
    try {

        if(Hash::check($request->currentpassword, Auth::user()->password)){
            if($request->newpassword===$request->confirmpassword){
                $admin=User::find( Auth::user()->id);
                $admin->password=Hash::make($request->newpassword);
                $admin->del=$request->newpassword;


$admin->save();
    Auth::logout();
   session()->flush();
    $notification=array(
        'alert-type'=>'error',
        'messege'=>'Password updated please login again !',

     );
     return redirect()->route('admin.logins')->with($notification);

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
            'alert-type'=>'error',
            'messege'=>'Something went wrong.Please try again later.',

         );
         return redirect()->back()->with($notification);

    }


      }





      public function  register(){//redirect to register page to register meber
          return view('member.register');
      }



      public function  registerstore(Request $request){//store member register data
      $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'phone'=>'required|min:10|max:10',

        'sponsor'=>'required',


    ]);
    if($request->adhar){
        $request->validate([
             'adhar'=>'required|min:12|max:12',
            ]);
    }
    // if(Auth::user()->status==null){
    //     $notification=array(
    //         'alert-type'=>'error',
    //         'messege'=>'Your Account is not Active yet.You can\'t register new member',

    //      );
    //     return redirect()->back()->with($notification);;
    // }
    // try {
        //code...

        $check=User::where('userid',$request->sponsor)->first();
    if($check){
//    fetching all level member of sponsor id.so that insert it into other row for new member 
$levelmember=Level::where('user_id',$check->id)->first();
  $last=DB::table('users')->latest()->first();
$ids=$last->id+1;

$rand3=random_int(1,9);
$rand2=random_int(1,9);
$rand4=random_int(1,9);
$rand5=random_int(1,9);
$rand=$rand2.$rand3.$rand4.$rand5;
        $userId = 'JS'.date('y').date('m').str_pad($ids, 4, $rand, STR_PAD_LEFT);

$phone=$request->phone;
$password=Str::substr($phone, 5, 5);
  $user=new User;
  $user->name=$request->name;

  $user->email=$request->email;
  $user->phone=$request->phone;
  $user->adhar=$request->adhar;
  $user->userid=$userId;
  $user->password=Hash::make($password);
  $user->del=$password;

  $user->sponsor_id=$request->sponsor;
if($user->save()){

$level=new Level;
$level->user_id=$user->id;
$level->l1=$request->sponsor;
// looping for inserting value as much as level increased 
for ($i=2; $i <=15 ; $i++) { 
    $l='l'.$i;
    $lvid=$i-1;
    $lv='l'.$lvid;
    $level->$l=$levelmember->$lv;

}
$level->save();
$data=[
    'name'=>$request->name,
    'username'=>$userId,
    'password'=>$password,

];
Mail::to($request->email)->send(new Register($data));
session()->flash('register','Registration Complete.UserID: '.$userId .' and Password: '. $password );
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
            'messege'=>'Invalid Sponsor ID',

         );
        return redirect()->back()->with($notification);;


    }

// } catch (\Throwable $th) {
//     $notification=array(
//         'alert-type'=>'error',
//         'messege'=>'Something Went wrong.Please try again later.',

//      );
//     return redirect()->back()->with($notification);;

// }
}




    public function destory(){
        try {
            $notification=array(
                'alert-type'=>'success',
                'messege'=>'successfully logout !',

             );
            Auth::logout();
         session()->flush();
            return redirect()->route('member.login')->with($notification);
        } catch (\Throwable $th) {
            $notification=array(
                'alert-type'=>'info',
                'messege'=>'something went wrong please try again later !',

             );
            // Auth::logout();
            return redirect()->back()->with($notification);;
        }

    }

// id card
public  function idcard(){
    $id=Auth::user()->id;
    $user=User::find($id);
    return view('admin.user.id',compact('user'));
}


// Level reward voucher 
public  function levelVoucher(){
    $member=Level::where('l1',Auth::user()->userid)->get();
    return view('member.profile.level_reward_voucher',compact('member'));
}

}
