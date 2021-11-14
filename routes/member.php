<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    Route::post('/login/store','Member\AuthController@login')->name('login.store');
});


// note member login route is in web route 
Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::middleware('auth')->group(function () {
   // Member profile
   Route::get('kyc','Member\KycController@index')->name('kyc');
   Route::post('kyc','Member\KycController@update')->name('kyc.update');


   Route::get('dashboard','Member\AuthController@show')->name('dashboard');
   Route::get('profile','Member\AuthController@profile')->name('profile');
   Route::get('password/change','Member\AuthController@password')->name('changepassword');

   Route::post('update-profile','Member\AuthController@update')->name('profile.update');
   Route::post('change-password','Member\AuthController@changePassword')->name('password');
   Route::post('logout','Member\AuthController@destory')->name('logout');
   Route::get('logout','Member\AuthController@destory')->name('logouts');
   Route::get('/register','Member\AuthController@register')->name('register');
   Route::get('/load-sponsor-data/{value}','Member\AuthController@sponsorData');

   Route::get('/my/idcard','Member\AuthController@idcard')->name('idcard');
   Route::get('/my/level/reward/voucher','Member\AuthController@levelVoucher')->name('level.reward.voucher');


   Route::post('/register','Member\AuthController@registerstore')->name('register');

// Epin

Route::get('epin/used','Member\EpinController@used')->name('epin.used');
Route::get('epin/unused','Member\EpinController@unused')->name('epin.unused');
Route::get('epin/request','Member\EpinController@request')->name('epin.request');
Route::get('epin/transfer/','Member\EpinController@transfer')->name('epin.transfer');
Route::post('epin/transfer/','Member\EpinController@transerferpin')->name('epin.store');
Route::post('ticket/store','Member\EpinController@store')->name('ticket.store');
Route::get('epin/transfer/history','Member\EpinController@transferhistory')->name('epin.transferhistory');
Route::get('epin/recive/history','Member\EpinController@recivehistory')->name('epin.recivehistory');
Route::get('/loadepin','Member\EpinController@loadepin');


// Member
Route::get('all','Member\MemberController@all')->name('all');
Route::get('inactive','Member\MemberController@inactive')->name('inactive');

Route::get('show/{id}','Member\MemberController@show')->name('show');
Route::get('level','Member\MemberController@level')->name('level');
Route::get('level','Member\MemberController@level')->name('level');
Route::get('level/show/{level}','Member\MemberController@levelshow')->name('level.show');
Route::get('level/treeview','Member\MemberController@treeview')->name('treeview');
Route::get('loadmemberdetail/{id}','Member\MemberController@loaddetail');

// Member Activation
Route::post('activation','Member\MemberController@activation')->name('activation');

Route::post('activation','Member\MemberController@activation')->name('activation');

Route::post('epin/activation','Member\MemberController@activation')->name('epin.unused.active');

// Level income
Route::get('income/level','Member\LevelearningController@level')->name('income.level');
Route::get('income/level','Member\LevelearningController@level')->name('income.level');
Route::get('income/level/show/{level}','Member\LevelearningController@levelincomeshow')->name('income.level.show');

Route::get('income/earning','Member\LevelearningController@levelearning')->name('income.earning');
Route::get('income/all','Member\LevelearningController@allearning')->name('income.all');


// Deposite
Route::get('deposite/request/create','Member\DepositeController@create')->name('deposite.request.create');
Route::post('deposite/request/store','Member\DepositeController@store')->name('deposite.request.store');
Route::get('deposite/pending','Member\DepositeController@pending')->name('deposite.pending');
Route::get('deposite/rejected','Member\DepositeController@rejected')->name('deposite.rejected');
Route::get('deposite/accepted','Member\DepositeController@accepted')->name('deposite.approved');



// Withdrawal
Route::get('withdrawal/request/create','Member\WithdrawalController@create')->name('withdrawal.request.create');
Route::post('withdrawal/request/store','Member\WithdrawalController@store')->name('withdrawal.request.store');
Route::get('withdrawal/pending','Member\WithdrawalController@pending')->name('withdrawal.pending');
Route::get('withdrawal/rejected','Member\WithdrawalController@rejected')->name('withdrawal.rejected');
Route::get('withdrawal/accepted','Member\WithdrawalController@accepted')->name('withdrawal.approved');

// purchase report 
Route::get('mebuy/report','Member\ReportController@buy')->name('buy.report');
Route::get('mereport/show/{id}/{orderId}','Member\ReportController@show')->name('report.show');
Route::get('mereport/print/{id}/{orderId}','Member\ReportController@print')->name('report.print');


// Repurchase 
Route::get('self/bv/','Member\RepurchaseController@selfBv')->name('self.bv');
Route::get('self/comission/','Member\RepurchaseController@selfComission')->name('self.comission');
Route::get('team/bv/','Member\RepurchaseController@teamBv')->name('team.bv');
Route::get('team/comission/','Member\RepurchaseController@teamComission')->name('team.comission');
Route::get('team/level/bv','Member\RepurchaseController@levelbv')->name('team.levelbv');
Route::get('team/level/bv/show/{level}','Member\RepurchaseController@levelbvshow')->name('level.bv.show');

});

Route::get('/register/refer/{name}/{userid}/{id}',function($name,$userid,$id){
    return view('register',compact('userid'));
})->name('refer.register');

 Route::post('/register/refer','Member\AuthController@registerstore')->name('register.refer');
