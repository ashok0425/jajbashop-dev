<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::middleware('auth:sanctum')->group(function () {   
    Route::get('/logout', 'Api\LoginController@logout');  
    Route::get('/me', 'Api\LoginController@me');    
    Route::get('/shipment/{rider}', 'Api\ShipmentController@shipment');    
    Route::get('/customer/search/{orderId}', 'Api\ShipmentController@search');    
    
    Route::get('/comment/{shipmentId}', 'Api\CommentController@comment');    
    Route::post('/comment/store', 'Api\CommentController@store');    
      Route::get('/status/show', 'Api\DataController@status'); 
    // Route::post('/account/update', 'Api\LoginController@update');   
    Route::post('/shipment/update', 'Api\ShipmentController@update');    
   Route::get('/dashboard/', 'Api\DataController@dashboard');  
    Route::get('/rider/msg/{riderId}', 'Api\DataController@ridermsg');  
   Route::post('/rider/msg/store', 'Api\DataController@ridermsgstore');
  Route::post('/account/changepassword', 'Api\LoginController@changepassword');  
  Route::get('/find/{status}', 'Api\ShipmentController@searchstatus'); 
  Route::get('/last/cod', 'Api\ShipmentController@lastCod'); //all
  Route::get('/deliver/latest', 'Api\ShipmentController@lastSuccessCod');
Route::get('/today/all', 'Api\ShipmentController@today');
  //deliver 

 Route::get('/filter/shipment/{query}', 'Api\ShipmentController@filter');
});
 
  




//login api 
Route::post('/login', 'Api\LoginController@login');

//total orders of a rider
