<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kyc;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
class KycController extends Controller
{
    public  function pending(){
        $kyc=DB::table('kycs')->join('users','users.id','kycs.user_id')->where('kycs.status',0)->select('kycs.*','users.userid','users.name as uname','users.id as uid')->get();

        return view('admin.kyc.pending',compact('kyc'));
    }

    public  function approved(){
        $kyc=DB::table('kycs')->join('users','users.id','kycs.user_id')->where('kycs.status',2)->select('kycs.*','users.userid','users.name as uname','users.id as uid')->get();
        return view('admin.kyc.approve',compact('kyc'));
    }

    public  function rejected(){
        $kyc=DB::table('kycs')->join('users','users.id','kycs.user_id')->where('kycs.status',1)->select('kycs.*','users.userid','users.name as uname','users.id as uid')->get();

        return view('admin.kyc.reject',compact('kyc'));
    }

    public  function show($id){
        $kyc=Kyc::where('user_id',$id)->first();
        return view('admin.kyc.show',compact('kyc'));
    }



    public  function update(Request $request){

//updating kyc status
$kyc=Kyc::find($request->id);
$kyc->name=$request->name;
$kyc->Bank_name=$request->Bank_name;
$kyc->account_no=$request->account_no;
$kyc->adhar_card_no=$request->adhar_card_no;
$kyc->ifsc=$request->ifsc;
$kyc->status=$request->status;
$kyc->pan_no=$request->pan_no;
$kyc->google_pay_id=$request->google_pay_id;
$kyc->phone_pay_id=$request->phone_pay_id;
$back=$request->file('adhar_back');
if($back){
    File::delete($kyc->adhar_back);
    $fname=rand().'back.'.$back->getClientOriginalExtension();
    $kyc->adhar_back='upload/kyc/back/'.$fname;
 $back->move(public_path().'/upload/kyc/back/',$fname);
}
$front=$request->file('adhar_front');

if($front){
    File::delete($kyc->adhar_front);
    $fname=rand().'front.'.$front->getClientOriginalExtension();
    $kyc->adhar_front='upload/kyc/front/'.$fname;
 $front->move(public_path().'/upload/kyc/front/',$fname);
}
$bankproof=$request->file('bankproof');

if($bankproof){
    File::delete($kyc->bankproof);
    $fname=rand().'bank.'.$bankproof->getClientOriginalExtension();
    $kyc->bankproof='upload/kyc/bank/'.$fname;
 $bankproof->move(public_path().'/upload/kyc/bank/',$fname);
}
$pancopy=$request->file('pancopy');

if($pancopy){
    File::delete($kyc->pancopy);
    $fname=rand().'pancopy.'.$pancopy->getClientOriginalExtension();
    $kyc->pancopy='upload/kyc/pan/'.$fname;
 $pancopy->move(public_path().'/upload/kyc/pan/',$fname);
}
$kyc->save();
$notification=array(
    'messege'=>'Kyc updated Sucessfully',
     'alert-type'=>'success'
 );

return redirect()->back()->with($notification);


    }

}
