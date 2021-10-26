<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/member/login/store','Member\AuthController@store')->name('member.login.store');

});


Route::middleware(['auth'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::middleware('auth')->group(function () {
   // Member profile
   Route::get('member/kyc','Member\KycController@index')->name('member.kyc');
   Route::post('member/kyc','Member\KycController@update')->name('member.kyc.update');


   Route::get('member/dashboard','Member\AuthController@show')->name('member.dashboard');
   Route::get('member/profile','Member\AuthController@profile')->name('member.profile');
   Route::get('member/password/change','Member\AuthController@password')->name('member.changepassword');

   Route::post('member/update-profile','Member\AuthController@update')->name('member.profile.update');
   Route::post('member/change-password','Member\AuthController@changePassword')->name('member.password');
   Route::post('member/logout','Member\AuthController@destory')->name('member.logout');
   Route::get('member/logout','Member\AuthController@destory')->name('logouts');
   Route::get('/member/register','Member\AuthController@register')->name('member.register');
   Route::get('/my/idcard','Member\AuthController@idcard')->name('member.idcard');
   Route::get('/my/level/reward/voucher','Member\AuthController@levelVoucher')->name('member.level.reward.voucher');


   Route::post('/member/register','Member\AuthController@registerstore')->name('member.register');


// Epin

Route::get('member/epin/used','Member\EpinController@used')->name('member.epin.used');
Route::get('member/epin/unused','Member\EpinController@unused')->name('member.epin.unused');
Route::get('member/epin/request','Member\EpinController@request')->name('member.epin.request');
Route::get('member/epin/transfer/','Member\EpinController@transfer')->name('member.epin.transfer');
Route::post('member/epin/transfer/','Member\EpinController@transerferpin')->name('member.epin.store');
Route::post('member/ticket/store','Member\EpinController@store')->name('member.ticket.store');
Route::get('member/epin/transfer/history','Member\EpinController@transferhistory')->name('member.epin.transferhistory');
Route::get('member/epin/recive/history','Member\EpinController@recivehistory')->name('member.epin.recivehistory');
Route::get('/loadepin','Member\EpinController@loadepin');


// Member
Route::get('member/all','Member\MemberController@all')->name('member.member.all');
Route::get('member/inactive','Member\MemberController@inactive')->name('member.member.inactive');

Route::get('member/show/{id}','Member\MemberController@show')->name('member.member.show');
Route::get('member/level','Member\MemberController@level')->name('member.member.level');
Route::get('member/level','Member\MemberController@level')->name('member.member.level');
Route::get('member/level/show/{level}','Member\MemberController@levelshow')->name('member.member.level.show');
Route::get('member/level/treeview','Member\MemberController@treeview')->name('member.member.treeview');
Route::get('loadmemberdetail/{id}','Member\MemberController@loaddetail');

// Member Activation
Route::post('member/activation','Member\MemberController@activation')->name('member.activation');

Route::post('member/activation','Member\MemberController@activation')->name('member.activation');

Route::post('member/epin/activation','Member\MemberController@activation')->name('member.epin.unused.active');

// Level income
Route::get('member/income/level','Member\LevelearningController@level')->name('member.income.level');
Route::get('member/income/level','Member\LevelearningController@level')->name('member.income.level');
Route::get('member/income/level/show/{level}','Member\LevelearningController@levelincomeshow')->name('member.income.level.show');

Route::get('member/income/earning','Member\LevelearningController@levelearning')->name('member.income.earning');
Route::get('member/income/all','Member\LevelearningController@allearning')->name('member.income.all');


// Deposite
Route::get('member/deposite/request/create','Member\DepositeController@create')->name('member.deposite.request.create');
Route::post('member/deposite/request/store','Member\DepositeController@store')->name('member.deposite.request.store');
Route::get('member/deposite/pending','Member\DepositeController@pending')->name('member.deposite.pending');
Route::get('member/deposite/rejected','Member\DepositeController@rejected')->name('member.deposite.rejected');
Route::get('member/deposite/accepted','Member\DepositeController@accepted')->name('member.deposite.approved');



// Withdrawal
Route::get('member/withdrawal/request/create','Member\WithdrawalController@create')->name('member.withdrawal.request.create');
Route::post('member/withdrawal/request/store','Member\WithdrawalController@store')->name('member.withdrawal.request.store');
Route::get('member/withdrawal/pending','Member\WithdrawalController@pending')->name('member.withdrawal.pending');
Route::get('member/withdrawal/rejected','Member\WithdrawalController@rejected')->name('member.withdrawal.rejected');
Route::get('member/withdrawal/accepted','Member\WithdrawalController@accepted')->name('member.withdrawal.approved');

// purchase report 
Route::get('memember/buy/report','Member\ReportController@buy')->name('member.buy.report');
Route::get('memember/report/show/{id}/{orderId}','Member\ReportController@show')->name('member.report.show');
Route::get('memember/report/print/{id}/{orderId}','Member\ReportController@print')->name('member.report.print');
});


// Repurchase 
Route::get('member/self/bv/','Member\RepurchaseController@selfBv')->name('member.self.bv');
Route::get('member/self/comission/','Member\RepurchaseController@selfComission')->name('member.self.comission');
Route::get('member/team/bv/','Member\RepurchaseController@teamBv')->name('member.team.bv');
Route::get('member/team/comission/','Member\RepurchaseController@teamComission')->name('member.team.comission');
Route::get('member/team/level/bv','Member\RepurchaseController@levelbv')->name('member.team.levelbv');
Route::get('member/team/level/bv/show/{level}','Member\RepurchaseController@levelbvshow')->name('member.level.bv.show');


Route::get('/',function(){
    return view('frontend.index');
})->name('/');


Route::get('/register/refer/{name}/{userid}/{id}',function($name,$userid,$id){
    return view('register',compact('userid'));
})->name('refer.register');

 Route::post('/member/register/refer','Member\AuthController@registerstore')->name('member.register.refer');




