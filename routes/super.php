<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super\AuthController;
use Illuminate\Support\Facades\Auth;
// Admin Auth
Route::middleware('guest:super')->group(function(){
    Route::get('/login','Super\AuthController@login')->name('super.logins');
    Route::post('/login','Super\AuthController@store')->name('super.login');
});

// Note :: active,deactive,destroy,method are place in Traits/status file


//admin guard middleware
Route::middleware('auth:super')->name('super.')->group(function () {

    // Admin profile
    Route::get('/dashboard','Super\AuthController@show')->name('dashboard');
    Route::get('/profile','Super\AuthController@profile')->name('profile');
    Route::get('/password/change','Super\AuthController@password')->name('changepassword');

    Route::post('/update-profile','Super\AuthController@update')->name('profile.update');
    Route::post('/change-password','Super\AuthController@changePassword')->name('password');
    Route::post('/logout','Super\AuthController@destory')->name('logout');
    Route::get('/logout','Super\AuthController@destory')->name('logouts');

    Route::post('/member/register','Super\MemberController@store')->name('member.register');

// purchase
Route::get('purchase/create','Super\PurchaseController@create')->name('purchase.create');
Route::get('purchase/getproductdata/{pid}','Super\PurchaseController@getData');
Route::get('purchase/store','Super\PurchaseController@store')->name('purchase.store');
Route::get('purchase/list','Super\PurchaseController@saleslist');
Route::get('purchase/delete/{id}','Super\PurchaseController@destroy');
Route::post('purchase/checkout','Super\PurchaseController@checkout')->name('purchase.checkout');
Route::get('paytm','Super\PaytmController@index')->name('paytm');
Route::post('payment/status','Super\PaytmController@paymentCallback')->name('paytm.status');



// inventory
Route::get('inventory','Super\InventoryController@index')->name('inventory');

// sales
Route::get('sales/list','Super\SaleController@index')->name('sale');
Route::get('sales/order/list','Super\SaleController@order')->name('sale.order');
Route::get('sales/order/accept/{id}','Super\SaleController@acceptorder')->name('order.accept');

Route::get('sales/create','Super\SaleController@create')->name('sale.create');
Route::get('getproductdata/{pid}','Super\SaleController@getData');
Route::get('sales/store','Super\SaleController@store')->name('sale.store');
Route::get('sales/list','Super\SaleController@saleslist');
Route::get('sales/delete/{id}','Super\SaleController@destroy');
Route::post('sales/checkout','Super\SaleController@checkout')->name('sale.checkout');






// Report
Route::get('sale/report','Super\ReportController@sale')->name('sale.report');
Route::get('buy/report','Super\ReportController@buy')->name('buy.report');
Route::get('report/show/{id}/{orderId}','Super\ReportController@show')->name('report.show');
Route::get('report/download/{id}/{orderId}','Super\ReportController@download')->name('report.print');
Route::get('dealer/list','Super\ReportController@dealer')->name('distributor');
Route::get('report/print/{id}/','Super\ReportController@print');




// Register Distributor
Route::get('/distributor/register','Super\AuthController@register')->name('distributor.register');
Route::post('/distributor/register/store','Super\AuthController@registerstore')->name('distributor.store');








});
