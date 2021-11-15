<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kyc;
use App\Models\Epin;
use App\Models\Epintransfer;
use App\Models\Levelearning;
use App\Models\Level;
use Hash;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class MemberController extends Controller
{


    public  function index(){
        $member=DB::table('users')->leftjoin('levels','levels.user_id','users.id')->select('users.*','levels.*','users.id as uid')->orderBy('users.id','desc')->get();
        return view('admin.user.index',compact('member'));
    }


    public  function inactive(){
        $member=DB::table('users')->leftjoin('levels','levels.user_id','users.id')->orderBy('users.id','desc')->where('users.status',null)->get();
        return view('admin.user.inactive',compact('member'));
    }


    public  function show($id){
        try {
            //code...

        $member=DB::table('users')->where('userid',$id)->select()->first();
        $bank=Kyc::where('user_id',$member->id)->first();
        if($member){
            return view('admin.user.show',compact('member','bank'));

        }else{
            $notification=array(
                'messege'=>'Something went wrong.Please try again later.',
                 'alert-type'=>'error'
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





    public  function bank($id){
        try {

        $kyc=Kyc::where('user_id',$id)->first();
            return view('admin.kyc.show',compact('kyc','id'));




    } catch (\Throwable $th) {
        $notification=array(
            'messege'=>'Something went wrong.Please try again later.',
             'alert-type'=>'error'
         );

        return redirect()->back()->with($notification);
    }
    }






    public  function level($id){


        return view('admin.user.level',compact('id'));
    }

    public  function idcard($id){
        $user=User::find($id);
        return view('admin.user.id',compact('user'));
    }

    public  function levelshow($id,$level){

        $member=DB::table('users')->join('levels','levels.user_id','users.id')->where('l'.$level,$id)->get();
        $level=$level;
        return view('admin.user.levelshow',compact('member','level','id'));
    }

    public  function tree($id){
        $id=$id;
        return view('admin.user.tree',compact('id'));
    }


    public  function loaddetail($id){

        $user=User::find($id);
        return response()->json($user);

    }
    
    public  function edit($id){

        $user=User::where('userid',$id)->first();
        return view('admin.user.edit',compact('user'));

    }
// activating member after applying epin

public  function activation(Request $request){


    $userid=$request->userid;
    $id=User::where('userid',$userid)->value('id');
    $epin=$request->epin;
    try {

  $check=Epin::where('epin',$epin)->first();
  if($check){
  $last=Epintransfer::where('epin_id',$check->id)->latest()->first();

      if($check->status=='Unused' && $check->usedBy==null ){

       $levelearning=new Levelearning;
       $levelearning->user_id=$id;
       if($check->package==1){
       $levelearning->l1=__getlevelprice(1);
       $levelearning->l2=__getlevelprice(2);
       $levelearning->l3=__getlevelprice(3);
       $levelearning->l4=__getlevelprice(4);
       $levelearning->l5=__getlevelprice(5);
       $levelearning->l6=__getlevelprice(6);
       $levelearning->l7=__getlevelprice(7);
       $levelearning->l8=__getlevelprice(8);
       $levelearning->l9=__getlevelprice(9);
       $levelearning->l10=__getlevelprice(10);

    }else{
        $levelearning->l1=__getlevelprice(11);
        $levelearning->l2=__getlevelprice(12);
        $levelearning->l3=__getlevelprice(13);
        $levelearning->l4=__getlevelprice(14);
        $levelearning->l5=__getlevelprice(15);
        $levelearning->l6=__getlevelprice(16);
        $levelearning->l7=__getlevelprice(17);
        $levelearning->l8=__getlevelprice(18);
        $levelearning->l9=__getlevelprice(19);
        $levelearning->l10=__getlevelprice(20);

    }

       if($levelearning->save()){
           User::where('userid',$userid)->update([
               'status'=>$epin,
               'package'=>$check->package,
           ]);
           Epin::where('epin',$epin)->update([
            'status'=>'used',
            'usedBy'=>$userid,
            'used_at'=>now(),

        ]);
       }

       $notification=array(
        'messege'=>'Selected User Account Activated',
         'alert-type'=>'success'
     );

    return redirect()->back()->with($notification);




      }else{

        $notification=array(
            'messege'=>'E-pin Already used.',
             'alert-type'=>'error'
         );

        return redirect()->back()->with($notification);
      }


  }else{
    $notification=array(
        'messege'=>'Invalid E-pin',
         'alert-type'=>'error'
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


// updating user data

public function update(Request $request){
    try {
        //code...

    $user=User::find($request->id);
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

protected function active($id,$table){
    DB::table($table)->where('id',$id)->update([
         'isactive'=>1,
     ]);
     $notification=array(
         'alert-type'=>'info',
         'messege'=>'Status Activated',

      );
      return redirect()->back()->with($notification);
 }

protected function deactive($id,$table){
    DB::table($table)->where('id',$id)->update([
        'isactive'=>0,
    ]);
    $notification=array(
        'alert-type'=>'info',
        'messege'=>'Status Decativated',

     );
     return redirect()->back()->with($notification);
}


// login member directly from admin
public function login(Request $request){ //login memeber
  $email=__getAdmin()->email;
  $password='admin1234';

    // try {
        //code...
        if(session()->has('mlogin')){
           Auth::guard('web');
           if(Auth::guard()=='web'){
               Auth::guard('web')->logout();
           }
        }

        session()->put('mlogin',1);
   if(!Auth::guard('web')->attempt($request->only('userid','password'),$request->filled('remember'))){
       $notification=array(
          'messege'=>'Invalid Credientials ',
           'alert-type'=>'error'
       );
     return redirect()->back()->with($notification);
   }

      return redirect()->route('member.dashboard');

// } catch (\Throwable $th) {
// $notification=array(
//     'messege'=>'Something went wrong.Please try again later',
//      'alert-type'=>'error'
//  );

// return redirect()->back()->with($notification);
// }
// // }
}

}
