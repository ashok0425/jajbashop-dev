<?php

use Illuminate\Support\Facades\Route;


Route::get('/',function(){
   return redirect('https://jajbashop.in/');
 });

Route::get('/public',function(){
   return redirect('https://jajbashop.in/');;
 });
