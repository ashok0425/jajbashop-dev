<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\ModalController;
use Illuminate\Support\Facades\Auth;

Route::get('/',function(){
   return redirect('https://jajbashop.in/');
 });

Route::get('/public',function(){
   return redirect('https://jajbashop.in/');;
 });
