<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Distributor\AuthController;
use Illuminate\Support\Facades\Auth;
// Admin Auth
Route::middleware('guest:distributor')->group(function(){
    Route::get('/login','Distributor\AuthController@login')->name('distributor.logins');
    Route::post('/login','Distributor\AuthController@store')->name('distributor.login');
});

// Note :: active,deactive,destroy,method are place in Traits/status file


//admin guard middleware
Route::middleware('auth:distributor')->name('distributor.')->group(function () {

    // Admin profile
    Route::get('/dashboard','Distributor\AuthController@show')->name('dashboard');
    Route::get('/profile','Distributor\AuthController@profile')->name('profile');
    Route::get('/password/change','Distributor\AuthController@password')->name('changepassword');

    Route::post('/update-profile','Distributor\AuthController@update')->name('profile.update');
    Route::post('/change-password','Distributor\AuthController@changePassword')->name('password');
    Route::post('/logout','Distributor\AuthController@destory')->name('logout');
    Route::get('/logout','Distributor\AuthController@destory')->name('logouts');

    Route::post('/member/register','Distributor\MemberController@store')->name('member.register');

// purchase
Route::get('purchase/create','Distributor\PurchaseController@create')->name('purchase.create');
Route::get('purchase/getproductdata/{pid}','Distributor\PurchaseController@getData');
Route::get('purchase/store','Distributor\PurchaseController@store')->name('purchase.store');
Route::get('purchase/list','Distributor\PurchaseController@saleslist');
Route::get('purchase/delete/{id}','Distributor\PurchaseController@destroy');

Route::post('purchase/checkout','Distributor\PurchaseController@checkout')->name('purchase.checkout');




// inventory
Route::get('inventory','Distributor\InventoryController@index')->name('inventory');

// sales
Route::get('sales/create','Distributor\SaleController@create')->name('sale.create');
Route::get('sales/getproductdata/{pid}','Distributor\SaleController@getData');
Route::get('sales/store','Distributor\SaleController@store')->name('sale.store');
Route::get('sales/list','Distributor\SaleController@saleslist');
Route::get('sales/delete/{id}','Distributor\SaleController@destroy');
Route::post('sales/checkout','Distributor\SaleController@checkout')->name('sale.checkout');
Route::get('loaduserdata/{data}','Distributor\SaleController@userdata');






// Report
Route::get('sale/report','Distributor\ReportController@sale')->name('sale.report');
Route::get('buy/report','Distributor\ReportController@buy')->name('buy.report');
Route::get('report/show/{id}/{orderId}','Distributor\ReportController@show')->name('report.show');
Route::get('report/print/{id}/{orderId}','Distributor\ReportController@print')->name('report.print');
Route::get('report/print/{id}/{orderId}','Distributor\ReportController@print')->name('report.print');
Route::get('dealer/list','Distributor\ReportController@dealer')->name('distributor');


// Register Distributor
Route::get('/distributor/register','Distributor\AuthController@register')->name('distributor.register');
Route::post('/distributor/register/store','Distributor\AuthController@registerstore')->name('distributor.store');








});
