<?php

use Illuminate\Support\Facades\Route;



// For member 

Route::middleware('guest')->group(function () {
    Route::post('/member/login/store','Frontend\AuthController@store')->name('login.store');

});

// Route::get('auth/google','Frontend\GoogleController@redirectToGoogle');
// Route::get('auth/google/callback','Frontend\GoogleController@handleGoogleCallback');
// Route::get('auth/facebook', 'Frontend\FbController@redirectToFacebook');
// Route::get('auth/facebook/callback','Frontend\FbController@facebookSignin');


Route::get('/', function () {
    return view('frontend.index');
})->name('/');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard',function(){
        return view('frontend.profile');
    })->name('dashboard');
        
});

Route::get('logout',function(){
    Auth::logout();
    session()->flush();
    $notification=array(
        'alert-type'=>'success',
        'messege'=>'Logged out successfully!',

     );

    return redirect()->route('login')->with($notification);
})->name('logout');


Route::middleware(['auth','Isactive'])->group(function () {
////profile
Route::get('/load-profile-data/{load}','Frontend\AuthController@loaddata');
Route::get('/profile','Frontend\AuthController@index')->name('profile');
Route::post('/profile/update/save','Frontend\AuthController@update')->name('profile.update');
Route::post('/shipping/update/save','Frontend\AuthController@shippingupdate')->name('shipping.update');
Route::post('/profile/change/password','Frontend\AuthController@changePassword')->name('profile.password');
Route::get('/profile/logout','Frontend\AuthController@destory')->name('profile.logout');
Route::post('/user/kyc','Frontend\KycController@update')->name('kyc.update');

//order
Route::get('orders/list/','Frontend\OrderController@index')->name('order');
Route::get('orders/show/{id}/{orderId}','Frontend\OrderController@show')->name('order.show');
Route::get('print-invoice/{order_id}','Frontend\OrderController@print')->name('order.print');
Route::get('orders/cancel/{id}/{orderId}','Frontend\OrderController@cancel')->name('order.cancel');
Route::post('orders/refund/','Frontend\OrderController@refund')->name('order.refund');







//buy now
Route::get('product/buy/now','Frontend\CartController@buynow')->name('buynow');


//checkout
Route::get('checkout/{value}/{id}','Frontend\CheckoutController@index')->name('checkout');
Route::post('checkout/store','Frontend\CheckoutController@store')->name('checkout.store');//cod
Route::get('payment/failed','Frontend\CheckoutController@failed')->name('payment.error');
Route::get('payment/success/{orderid}','Frontend\CheckoutController@success')->name('payment.success');



//wishlist
Route::get('wishlist/list','Frontend\WishlistController@index')->name('wishlist');
Route::get('/wishlist/store/{id}','Frontend\WishlistController@store')->name('wishlist.store');
Route::get('add/cart/{id}','Frontend\WishlistController@cart')->name('wishlist.cart');
Route::get('wishlist/remove/{id}','Frontend\WishlistController@destroy')->name('wishlist.remove');

//compare list 
Route::get('compare/list','Frontend\CompareController@index')->name('compare');
Route::get('/compare/store/{id}','Frontend\CompareController@store')->name('compare.store');
Route::get('compare/remove/{id}','Frontend\CompareController@destroy')->name('compare.remove');

//payemet with razor pay 
Route::get('checkout/razorpay','Frontend\RazorpayController@index')->name('razorpay');
Route::post('checkout/razorpay/pay','Frontend\RazorpayController@pay')->name('razorpay.pay');




});



// track order
Route::post('order/track/status','Frontend\OrderController@orderTrack')->name('track.my.order');


//search product using ajax
Route::get('loadproduct/{name}/{catgeory?}','Frontend\ProductController@search');
Route::get('product/quickview/{id}/{value}','Frontend\ProductController@quickview');


//cart
Route::get('cart/list','Frontend\CartController@index')->name('cart');
Route::get('cartqty/{val}/{id}/{price}/{charge}','Frontend\CartController@update');
Route::get('/product/cart/store','Frontend\CartController@store')->name('cart.store');
Route::post('/coupon','Frontend\CartController@coupon')->name('coupon');
Route::get('/coupon/delete','Frontend\CartController@CouponRemove')->name('coupon.remove');
Route::get('/cart/delete/{id}','Frontend\CartController@destroy')->name('cart.remove');




//Product details
Route::get('product/{id}/{slug?}','Frontend\ProductController@productDetail')->name('product.detail');
Route::get('loadimage/{val}/','Frontend\ProductController@loadImage');
Route::get('loadprice/{vid}','Frontend\ProductController@loadPrice');
Route::get('loadproduct-detail/{load}/{id}','Frontend\ProductController@loadproductDetail');


//product rating

Route::get('product/review/store/save','Frontend\ProductreviewController@store')->name('product.rating.store');
Route::get('product/review/edit/{id}','Frontend\ProductreviewController@edit')->name('product.rating.edit');
Route::post('product/review/update','Frontend\ProductreviewController@update')->name('product.rating.update');
Route::get('product/review/delete/{id}','Frontend\ProductreviewController@destroy')->name('product.rating.delete');

//product rating Reply

Route::get('product/review/reply/save','Frontend\ProductreviewController@replystore')->name('product.rating.reply.store');
Route::get('product/review/edit/{id}','Frontend\ProductreviewController@ratingEdit')->name('product.rating.edit');
Route::post('product/review/update','Frontend\ProductreviewController@ratingUpdate')->name('product.rating.update');
Route::get('product/review/delete/{id}','Frontend\ProductreviewController@ratingDestroy')->name('product.rating.delete');

//product question 

Route::get('product/question/store/save','Frontend\ProductqaController@store')->name('product.question.store');
Route::get('product/answer/store/save','Frontend\ProductqaController@answer')->name('product.answer.store');


//store
Route::get('store/{id}','Frontend\ProductController@allProduct')->name('store.all');
Route::get('store/search/','Frontend\ProductController@productSearch')->name('store.search');
Route::get('store/category/{id}/{name}','Frontend\ProductController@categoryproduct')->name('store.category');
Route::get('store/category/subcategory/{id}/{name}','Frontend\ProductController@subcategoryproduct')->name('store.subcategory');
Route::get('store/category/subcateg/brand/{id}/{name}','Frontend\ProductController@brandproduct')->name('store.brand');
Route::GET('filterproduct/ajax','Frontend\ProductController@filterProductAjax');

//faq
Route::get('faq','Frontend\BlogController@faq')->name('faq');


//blog
Route::get('blog/','Frontend\BlogController@index')->name('blog');
Route::get('blogdetail/{id}/{title}','Frontend\BlogController@single')->name('blog.single');

//subscriber
Route::post('subscriber/store','Frontend\ContactController@subscriber')->name('subscriber');

//contact
Route::get('contact/','Frontend\ContactController@index')->name('contact');
Route::post('contact/store','Frontend\ContactController@store')->name('contact.store');
Route::post('subscribe/store','Frontend\ContactController@subscribe')->name('subscribe.store');

//Vendor detail page
Route::get('seller/{id}/{name?}','Frontend\SellerController@index')->name('seller');
Route::get('seller-detail/{load}/{id}','Frontend\SellerController@loadDetail');
//product rating
Route::get('seller/review/store/save','Frontend\SellerreviewController@store')->name('seller.rating.store');
Route::get('seller/review/edit/{id}','Frontend\SellerreviewController@edit')->name('seller.rating.edit');
Route::post('seller/review/update','Frontend\SellerreviewController@update')->name('seller.rating.update');
Route::get('seller/review/delete/{id}','Frontend\SellerreviewController@destroy')->name('seller.rating.delete');
//seller rating Reply
Route::get('seller/review/reply/save','Frontend\SellerreviewController@replystore')->name('seller.rating.reply.store');
Route::get('seller/review/edit/{id}','Frontend\SellerreviewController@ratingEdit')->name('seller.rating.edit');
Route::post('seller/review/update','Frontend\SellerreviewController@ratingUpdate')->name('seller.rating.update');
Route::get('seller/review/delete/{id}','Frontend\SellerreviewController@ratingDestroy')->name('seller.rating.delete');

//product question 


//pages
Route::get('/about-us', function () {
    return view('frontend.about');
})->name('about');
Route::get('/term-condition', function () {
    return view('frontend.term');
})->name('term');
Route::get('/seller/handbook', function () {
    return view('frontend.price');
})->name('price');
Route::get('/privacy-policy', function () {
    return view('frontend.privacy');
})->name('privacy');

Route::get('/return-refund-policy', function () {
    return view('frontend.refund');
})->name('return');

Route::get('/seller-guide', function () {
    return view('frontend.sellerguide');
})->name('seller.guide');


Route::get('/advertise-guide', function () {
    return view('frontend.advertise');
})->name('advertise.guide');

Route::get('/business-guide', function () {
    return view('frontend.bussinessguide');
})->name('business.guide');

Route::get('/help-center', function () {
    return view('frontend.help');
})->name('help');

Route::get('/invoice/load','Frontend\CheckoutController@invoice')->name('invoice');

