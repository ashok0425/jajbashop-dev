<?php
namespace App\Http\Controllers\Super;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Cookie;
use PaytmWallet;
use App\Http\Traits\status;
class PaytmController  extends Controller
{
    use status;
// creating paytm payment
  public function index(){
    $name=Auth::user()->name;
    $email=Auth::user()->email;
    $phone=Auth::user()->phone;
    $datas=json_decode(cookie::get('jajbashop'));

    if(!empty($datas)){
      $orderId=$datas->order_id;
    $payment = PaytmWallet::with('receive');
    $payment->prepare([
      'order' => "$orderId",
      'user' => Auth::user()->id,
      'mobile_number' =>  "$phone",
      'email' => "$email",
      'amount' => $datas->amount,
      'callback_url' => route('super.paytm.status')
    ]);
    return $payment->receive();
  }else{
    return redirect()->route('/');
  }

    }

    


    // payment status after traction 
    public function paymentCallback()
    {
 
        $transaction = PaytmWallet::with('receive');
        $response = $transaction->response(); // To get raw response as array
        //Check out response parameters sent by paytm here -> http://paywithpaytm.com/developer/paytm_api_doc?target=interpreting-response-sent-by-paytm
        if($transaction->isOpen()){
          //Transaction opening
        }else if($transaction->isFailed()){

          return redirect()->route('payment.error');
          
        }else if($transaction->isSuccessful()){
          //Transaction Sucessfull
          $datas=json_decode(Cookie::get('jajbashop'));

          $this->orderPush($datas->order_id,$datas->total,$datas->comission,$datas->bv,'Prepaid',$datas->sale,$datas->buyer,$datas->seller,$datas->seller_id,$datas->buyer_id,$datas->ship);

        }

    }


  }


