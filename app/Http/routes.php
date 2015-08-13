<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return View::make('home.home');
});

Route::get('home', function () {
    return View::make('home.home');
});

Route::get('product',function(){
    return View::make('product.product');
});

Route::get('news',function(){
   return View::make('news.news');
});

Route::get('member',function(){
   return View::make('member.member');
});

Route::get('contact', function () {
    return View::make('contact.contact')->with('name','Contact');
});

