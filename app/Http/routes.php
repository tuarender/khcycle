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

Route::get('catalogue','CatalogueController@index');

Route::get('product',function(){
    return View::make('product.product');
});

Route::get('contact', function () {
    return View::make('contact.contact')->with('name','Contact');
});

Route::get('member','MemberController@index');
Route::post('login','MemberController@postLogin');

Route::get('register','MemberController@register');
Route::post('register','MemberController@postregister');
Route::get('forgetpassword','MemberController@forgetpassword');

Route::get('product', 'ProductController@index');
Route::get('product/{brandId}/{groupId?}', 'ProductController@getProduct');

Route::get('news','NewsController@getNewsList');
Route::get('news/{newsId}','NewsController@getNews');
