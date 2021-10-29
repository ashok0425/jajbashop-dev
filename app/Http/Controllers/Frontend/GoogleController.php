<?php
  
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
  
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\Ecommerce\User;
use Illuminate\Support\Facades\Auth;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended(session()->get('url'));
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                     'email_verified_at'=> now(),
                    'password' => encrypt('123456dummy')
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended(session()->get('url'));
            }
      
        } catch (Exception $e) {
            $notification=array(
                   'messege'=>'Something went wrong.Please Try again later',
                   'alert-type'=>'error'
                 );
            return redirect()->route('login')->with($notification);
        }
    }
}