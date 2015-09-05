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

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::get('catalogue','CatalogueController@index');

Route::get('product',function(){
    return View::make('product.product');
});

Route::get('member','MemberController@index');
//Route::get('listmember',function(){
//   return View::make('member.listmember')->with('name','Member');
//});
Route::get('listmember','MemberController@listmember');
Route::post('listmember','MemberController@listmember');
Route::post('login','MemberController@postLogin');
Route::get('forgetpassword','MemberController@forgetpassword');
Route::get('profile','MemberController@profilemember');
Route::get('logout','MemberController@logout');
Route::post('logout','MemberController@logout');
Route::post('updatemember/{id}','MemberController@update');

Route::get('member/{id}','MemberController@show');

Route::get('contact', function () {
    return View::make('contact.contact')->with('name','Contact');
});

Route::get('register','MemberController@register');
Route::post('register','MemberController@postregister');

Route::get('product', 'ProductController@index');
Route::get('product/brand/{brandId}', 'ProductController@index');
Route::get('product/{brandId}/{groupId?}', 'ProductController@getProduct');

Route::get('news','NewsController@getNewsList');
Route::get('newsHome','NewsController@getNewsListHome');
Route::get('news/{newsId}','NewsController@getNews');
