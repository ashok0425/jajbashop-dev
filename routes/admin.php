<?php

use Illuminate\Support\Facades\Route;

// Admin Auth
Route::middleware('guest:admin')->group(function(){
    Route::get('/login','Admin\AuthController@index')->name('admin.logins');
    Route::post('/login','Admin\AuthController@store')->name('admin.login');
});

// Note :: active,deactive,destroy,method are place in Traits/status file


//admin guard middleware
Route::middleware('auth:admin')->name('admin.')->group(function () {

    // Admin profile
    Route::get('/dashboard','Admin\AuthController@show')->name('dashboard');
    Route::get('/profile','Admin\AuthController@profile')->name('profile');
    Route::get('/password/change','Admin\AuthController@password')->name('changepassword');

    Route::post('/update-profile','Admin\AuthController@update')->name('profile.update');
    Route::post('/change-password','Admin\AuthController@changePassword')->name('password');
    Route::post('/logout','Admin\AuthController@destory')->name('logout');
    Route::get('/logout','Admin\AuthController@destory')->name('logouts');

    Route::post('/member/register','Admin\MemberController@store')->name('member.register');


    // Role
    Route::get('/role/list','Admin\AuthController@role')->name('role');
    Route::get('/role/create','Admin\AuthController@roleCreate')->name('role.create');
    Route::post('/role/store','Admin\AuthController@roleStore')->name('role.store');
    Route::get('/role/edit/{id}','Admin\AuthController@roleEdit')->name('role.edit');
    Route::post('/role/update','Admin\AuthController@roleUpdate')->name('role.update');
    Route::get('/role/update/{id}','Admin\AuthController@roleUpdate')->name('role.delete');

    Route::get('/role/active/{id}/{table}','Admin\AuthController@deactive')->name('role.active');
    Route::get('/role/deactive/{id}/{table}','Admin\AuthController@active')->name('role.deactive');


// E-pin route
Route::get('/epin/used','Admin\EpinController@used')->name('epin.used');
Route::get('/epin/unused','Admin\EpinController@unused')->name('epin.unused');
Route::get('/epin/request','Admin\EpinController@request')->name('epin.request');
Route::get('/epin/transfer/{userid?}','Admin\EpinController@transfer')->name('epin.transfer');
Route::get('/epin/list/histroy','Admin\EpinController@history')->name('epin.transfer.history');
Route::post('/epin/store','Admin\EpinController@store')->name('epin.store');
Route::get('/loadepin','Admin\EpinController@loadepin');



// level Price
Route::get('/level/price','Admin\LevelController@index')->name('level.price');
Route::get('/level/price/edit/{id}','Admin\LevelController@edit')->name('level.price.edit');
Route::post('/level/price/update','Admin\LevelController@update')->name('level.price.update');

// Level repurchase topup price
Route::get('/repurchasetopup/price','Admin\Repurchase\RepurchasetopupController@index')->name('repurchasetopup');
Route::get('/repurchasetopup/price/edit/{id}','Admin\Repurchase\RepurchasetopupController@edit')->name('repurchasetopup.edit');
Route::post('/repurchasetopup/price/update','Admin\Repurchase\RepurchasetopupController@update')->name('repurchasetopup.update');



// user
Route::get('/user/all','Admin\MemberController@index')->name('user.all');
Route::get('/user/inactive','Admin\MemberController@inactive')->name('user.inactive');
Route::get('/user/show/{id}','Admin\MemberController@show')->name('user.show');
Route::get('/user/level/{id}','Admin\MemberController@level')->name('user.level');
Route::get('/user/level/show/{id}/{level}','Admin\MemberController@levelshow')->name('user.level.show');
Route::get('/user/tree/{id}','Admin\MemberController@tree')->name('user.tree');
Route::get('loadmemberdetail/{id}','Member\MemberController@loaddetail');
Route::post('/user/activation','Admin\MemberController@activation')->name('user.activation');
Route::get('/user/edit/{id}','Admin\MemberController@edit')->name('user.edit');
Route::post('/user/update','Admin\MemberController@update')->name('user.update');
Route::get('/user/id/{id}','Admin\MemberController@idcard')->name('user.id');
Route::get('/user/active/{id}/{table}','Admin\MemberController@active')->name('user.active');
Route::get('/user/deactive/{id}/{table}','Admin\MemberController@deactive')->name('user.deactive');


// Kyc
Route::get('/user/kyc/show/{id}','Admin\KycController@show')->name('kyc.show');
Route::post('/user/kyc/updated','Admin\KycController@update')->name('kyc.update');
Route::get('/user/kyc/pending','Admin\KycController@pending')->name('kyc.pending');
Route::get('/user/kyc/approved','Admin\KycController@approved')->name('kyc.approved');
Route::get('/user/kyc/rejected','Admin\KycController@rejected')->name('kyc.rejected');


// user income

Route::get('/user/level/income/{id}','Admin\LevelearningController@levelearning')->name('user.income.level');
Route::get('/user/level/income/show/{userid}/{level}','Admin\LevelearningController@levelincomeshow')->name('user.income.level.show');


// user withdrawal
Route::post('/user/withdrawal/request/update','Admin\WithdrawalController@update')->name('user.withdrawal.request.updated');

Route::get('/user/withdrawal/pending','Admin\WithdrawalController@pending')->name('user.withdrawal.pending');
Route::get('/user/withdrawal/approved','Admin\WithdrawalController@approved')->name('user.withdrawal.approved');
Route::get('/user/withdrawal/rejected','Admin\WithdrawalController@rejected')->name('user.withdrawal.rejected');


// Deposite
Route::post('user/deposite/request/update','Admin\DepositeController@update')->name('user.deposite.request.update');
Route::get('user/deposite/pending','Admin\DepositeController@pending')->name('user.deposite.pending');
Route::get('user/deposite/rejected','Admin\DepositeController@rejected')->name('user.deposite.rejected');
Route::get('user/deposite/accepted','Admin\DepositeController@accepted')->name('user.deposite.approved');



// ***********Ecommerce Section with Repurchase **********

// category

Route::get('/category','Admin\Repurchase\CategoryController@index')->name('category');
Route::get('/category/create','Admin\Repurchase\CategoryController@create')->name('category.create');
Route::post('/category/store','Admin\Repurchase\CategoryController@store')->name('category.store');
Route::get('/category/edit/{id}/','Admin\Repurchase\CategoryController@edit')->name('category.edit');
Route::post('/category/edit/','Admin\Repurchase\CategoryController@update')->name('category.update');
Route::get('/category/show/{id}','Admin\Repurchase\CategoryController@show')->name('category.show');
Route::get('/category/active/{id}/{table}','Admin\Repurchase\CategoryController@active')->name('category.active');
Route::get('/category/deactive/{id}/{table}','Admin\Repurchase\CategoryController@deactive')->name('category.deactive');
Route::get('/category/delete/{id}/{table}','Admin\Repurchase\CategoryController@destroy')->name('category.delete');


// Subcategory
Route::get('/subcategory','Admin\Repurchase\SubcategoryController@index')->name('subcategory');
Route::get('/subcategory/create','Admin\Repurchase\SubcategoryController@create')->name('subcategory.create');
Route::post('/subcategory/store','Admin\Repurchase\SubcategoryController@store')->name('subcategory.store');
Route::get('/subcategory/edit/{id}/','Admin\Repurchase\SubcategoryController@edit')->name('subcategory.edit');
Route::post('/subcategory/edit/','Admin\Repurchase\SubcategoryController@update')->name('subcategory.update');
Route::get('/subcategory/show/{id}','Admin\Repurchase\SubcategoryController@show')->name('subcategory.show');
Route::get('/subcategory/active/{id}/{table}','Admin\Repurchase\SubcategoryController@active')->name('subcategory.active');
Route::get('/subcategory/deactive/{id}/{table}','Admin\Repurchase\SubcategoryController@deactive')->name('subcategory.deactive');
Route::get('/subcategory/delete/{id}/{table}','Admin\Repurchase\SubcategoryController@destroy')->name('subcategory.delete');

// Product

Route::get('/product','Admin\Repurchase\ProductController@index')->name('product');
Route::get('/deactiveproduct','Admin\Repurchase\ProductController@deactiveproduct')->name('deactiveproduct');
Route::get('/product/create','Admin\Repurchase\ProductController@create')->name('product.create');
Route::post('/product/store','Admin\Repurchase\ProductController@store')->name('product.store');
Route::get('/product/edit/{id}/','Admin\Repurchase\ProductController@edit')->name('product.edit');
Route::post('/product/edit/','Admin\Repurchase\ProductController@update')->name('product.update');
Route::get('/product/show/{id}','Admin\Repurchase\ProductController@show')->name('product.show');
Route::get('/product/active/{id}/{table}','Admin\Repurchase\ProductController@active')->name('product.active');
Route::get('/product/deactive/{id}/{table}','Admin\Repurchase\ProductController@deactive')->name('product.deactive');
Route::get('/product/delete/{id}/{table}','Admin\Repurchase\ProductController@destroy')->name('product.delete');
Route::get('/product/attribute/{id}/','Admin\Repurchase\ProductController@addAttribute')->name('product.attribute');
Route::get('loaddata/{table}/{id}/{option?}','Admin\Repurchase\ProductController@loadData');


// superdistributor 
Route::get('/super/list','Admin\Repurchase\SuperController@index')->name('super');
Route::get('/super/register','Admin\Repurchase\SuperController@create')->name('super.create');
Route::post('/super/register/store','Admin\Repurchase\SuperController@store')->name('super.store');
Route::get('/super/show/{id}','Admin\Repurchase\SuperController@show')->name('super.show');
Route::get('/super/active/{id}/{table}','Admin\Repurchase\SuperController@active')->name('super.active');
Route::get('/super/deactive/{id}/{table}','Admin\Repurchase\SuperController@deactive')->name('super.deactive');
Route::get('/super/distributor/list/{id}','Admin\Repurchase\SuperController@distributor')->name('super.distributor');
Route::get('/super/sales/list/{id}','Admin\Repurchase\SuperController@sales')->name('super.sales');
Route::get('/super/purchase/list/{id}','Admin\Repurchase\SuperController@purchase')->name('super.purchase');
Route::get('/super/edit/{id}','Admin\Repurchase\SuperController@edit')->name('super.edit');
Route::post('/super/update/','Admin\Repurchase\SuperController@update')->name('super.update');

Route::get('/super/order/detail/{id}/{orderId}','Admin\Repurchase\SuperController@orderdetail')->name('super.order.show');
Route::get('/super/order/download/{id}/{orderId}','Admin\Repurchase\SuperController@download')->name('super.order.print');
Route::get('/supers/order/print/{id}','Admin\Repurchase\SuperController@print');


// make sales to super distributor
Route::get('sale/create','Admin\Repurchase\SaleController@create')->name('sale.create');
Route::get('sale/getproductdata/{pid}','Admin\Repurchase\SaleController@getData');
Route::get('sale/store','Admin\Repurchase\SaleController@store')->name('sale.store');
Route::get('sale/list','Admin\Repurchase\SaleController@saleslist');
Route::get('sale/delete/{id}','Admin\Repurchase\SaleController@destroy');
Route::post('sale/checkout','Admin\Repurchase\SaleController@checkout')->name('sale.checkout');




// superdistributor 
Route::get('/distributor/list','Admin\Repurchase\DistributorController@index')->name('distributor');
Route::get('/distributor/pending/list','Admin\Repurchase\DistributorController@index')->name('distributor.pending');
Route::get('/distributor/show/{id}','Admin\Repurchase\DistributorController@show')->name('distributor.show');
Route::get('/distributor/active/{id}/{table}','Admin\Repurchase\DistributorController@active')->name('distributor.active');
Route::get('/distributor/deactive/{id}/{table}','Admin\Repurchase\DistributorController@deactive')->name('distributor.deactive');
Route::get('/distributor/sales/list/{id}','Admin\Repurchase\DistributorController@sales')->name('distributor.sales');
Route::get('/distributor/purchase/list/{id}','Admin\Repurchase\DistributorController@purchase')->name('distributor.purchase');
Route::get('/distributor/edit/list/{id}','Admin\Repurchase\DistributorController@edit')->name('distributor.edit');
Route::post('/distributor/update/','Admin\Repurchase\DistributorController@update')->name('distributor.update');
Route::get('/distributor/order/detail/{id}/{orderId}','Admin\Repurchase\DistributorController@orderdetail')->name('distributor.order.show');
Route::get('/distributor/order/download/{id}/{orderId}','Admin\Repurchase\DistributorController@print')->name('distributor.order.print');
Route::get('/distributor/order/print/{id}','Admin\Repurchase\SuperController@print');









// Repurchase 
Route::get('/repurchase/commission/list','Admin\Repurchase\RepurchaseController@index')->name('repurchase.comission');
Route::get('/repurchase/commission/{id}','Admin\Repurchase\RepurchaseController@edit')->name('repurchase.comission.edit');
Route::post('/repurchase/commission/update','Admin\Repurchase\RepurchaseController@update')->name('repurchase.comission.update');









//  direct login to other panel from admin panel
Route::post('/user/login/','Admin\MemberController@login')->name('user.login');//member login
Route::post('/super/login/','Admin\Repurchase\SuperController@login')->name('super.login');//super login
Route::post('/distributor/login/','Admin\Repurchase\DistributorController@login')->name('distributor.login');//super login


});


