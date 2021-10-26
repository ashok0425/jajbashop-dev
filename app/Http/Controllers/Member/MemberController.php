<?php
namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kyc;
use App\Models\Epin;
use App\Models\Levelearning;
use App\Models\Epintransfer;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
class MemberController extends Controller
{
    public  function inactive(){
        $member=DB::table('users')->join('levels','levels.user_id','users.id')->where(function($level){
$level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid)->orwhere('levels.l11',Auth::user()->userid)->orwhere('levels.l12',Auth::user()->userid)->orwhere('levels.l13',Auth::user()->userid)->orwhere('levels.l14',Auth::user()->userid)->orwhere('levels.l15',Auth::user()->userid);
        })->where('users.status',null)->orderBy('users.id','desc')->get();
        return view('member.member.all',compact('member'));
    }

    public  function all(){
        $member=DB::table('users')->join('levels','levels.user_id','users.id')->where(function($level){
$level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid)->orwhere('levels.l11',Auth::user()->userid)->orwhere('levels.l12',Auth::user()->userid)->orwhere('levels.l13',Auth::user()->userid)->orwhere('levels.l14',Auth::user()->userid)->orwhere('levels.l15',Auth::user()->userid);
        })->orderBy('users.id','desc')->get();
        return view('member.member.all',compact('member'));
    }



    public  function show($id){
        try {
            //code...

        $member=DB::table('users')->join('levels','levels.user_id','users.id')->where(function($level){
$level->where('levels.l1',Auth::user()->userid)->orwhere('levels.l2',Auth::user()->userid)->orwhere('levels.l3',Auth::user()->userid)->orwhere('levels.l4',Auth::user()->userid)->orwhere('levels.l5',Auth::user()->userid)->orwhere('levels.l6',Auth::user()->userid)->orwhere('levels.l7',Auth::user()->userid)->orwhere('levels.l8',Auth::user()->userid)->orwhere('levels.l9',Auth::user()->userid)->orwhere('levels.l10',Auth::user()->userid)->orwhere('levels.l11',Auth::user()->userid)->orwhere('levels.l12',Auth::user()->userid)->orwhere('levels.l13',Auth::user()->userid)->orwhere('levels.l14',Auth::user()->userid)->orwhere('levels.l15',Auth::user()->userid);
        })->where('users.userid',$id)->first();
        $bank=Kyc::where('user_id',$member->id)->first();
        if($member){
            return view('member.member.show',compact('member','bank'));

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



    public  function level(){

        return view('member.member.level');
    }


    public  function levelshow($id){

        $member=DB::table('users')->join('levels','levels.user_id','users.id')->where('l'.$id,Auth::user()->userid)->get();
        $level=$id;
        return view('member.member.levelshow',compact('member','level'));
    }

    public  function treeview(){

        return view('member.member.tree');
    }


    public  function loaddetail($id){

        $user=User::find($id);
        return response()->json($user);

    }

// activating member after applying epin

public  function activation(Request $request){


    $userid=$request->userid;

    $id=User::where('userid',$userid)->first();
    $epin=$request->epin;
    try {
       if(($id->status)){
        $notification=array(
            'messege'=>' User Account Already Activated',
             'alert-type'=>'info'
         );

        return redirect()->back()->with($notification);
       }
  $check=Epin::where('epin',$epin)->first();
  if($check){
  $last=Epintransfer::where('epin_id',$check->id)->latest()->first();

      if($last->receiver==Auth::user()->userid){
      if($check->status=='Unused' && $check->usedBy==null ){

       $levelearning=new Levelearning;
       $levelearning->user_id=$id->id;
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
            'messege'=>'This E-pin doesn\'t belongs to you. Please enter valid E-pin.',
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




}
