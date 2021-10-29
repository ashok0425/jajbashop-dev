<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecommerce\User;
use App\Models\Ecommerce\Userkyc;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
class KycController extends Controller
{



    public  function update(Request $request){

           $request->validate([
               'adhar_card_no'=>'required',
               'ifsc'=>'required',
               'account_no'=>'required',
           ]);

$check=DB::connection('mysql')->table('userkycs')->where('user_id',Auth::user()->id)->first();
if($check){//checking wheter user is updated or not
$kyc=Userkyc::find($check->id);
$kyc->name=$request->name;
$kyc->Bank_name=$request->Bank_name;
$kyc->account_no=$request->account_no;
$kyc->adhar_card_no=$request->adhar_card_no;
$kyc->ifsc=$request->ifsc;
$kyc->pan_no=$request->pan_no;
$kyc->phone=$request->phone;
$kyc->google_pay_id=$request->google_pay_id;
$kyc->phone_pay_id=$request->phone_pay_id;
$kyc->save();
$notification=array(
    'messege'=>'Kyc updated Sucessfully',
     'alert-type'=>'success'
 );

return redirect()->back()->with($notification);

}else{//kyc not updated
    $kyc=new Userkyc;
    $kyc->name=$request->name;
    $kyc->user_id=Auth::user()->id;
    $kyc->Bank_name=$request->Bank_name;
    $kyc->account_no=$request->account_no;
    $kyc->adhar_card_no=$request->adhar_card_no;
    $kyc->ifsc=$request->ifsc;
    $kyc->pan_no=$request->pan_no;
    $kyc->google_pay_id=$request->google_pay_id;
    $kyc->phone_pay_id=$request->phone_pay_id;
    $kyc->phone=$request->phone;

    $back=$request->file('adhar_back');
    if($back){
        $fname=rand().'back.'.$back->getClientOriginalExtension();
        $kyc->adhar_back='upload/kyc/back/'.$fname;
     $back->move(public_path().'/upload/kyc/back/',$fname);
    }


    $front=$request->file('adhar_front');

    if($front){
        $fname=rand().'front.'.$front->getClientOriginalExtension();
        $kyc->adhar_front='upload/kyc/front/'.$fname;
     $front->move(public_path().'/upload/kyc/front/',$fname);
    }


    $bankproof=$request->file('bankproof');

    if($bankproof){
        $fname=rand().'bankproof.'.$bankproof->getClientOriginalExtension();
        $kyc->bankproof='upload/kyc/bank/'.$fname;
     $bankproof->move(public_path().'/upload/kyc/bank/',$fname);
    }


    $pancopy=$request->file('pancopy');

    if($pancopy){
        $fname=rand().'pancopy.'.$pancopy->getClientOriginalExtension();
        $kyc->pancopy='upload/kyc/pan/'.$fname;
     $pancopy->move(public_path().'/upload/kyc/pan/',$fname);
    }
    $kyc->save();
    $notification=array(
        'messege'=>'Kyc Added Sucessfully',
         'alert-type'=>'success'
     );

    return redirect()->back()->with($notification);


}


    }

}
