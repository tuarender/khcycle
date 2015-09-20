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
Route::get('member','MemberController@index');
Route::post('login','MemberController@postLogin');
Route::get('forgetpassword','MemberController@forgetpassword');
Route::get('profile','MemberController@profilemember');
Route::get('logout','MemberController@logout');
Route::post('logout','MemberController@logout');
//Route::post('updatemember/{id}','MemberController@update');

Route::get('member/{id}','MemberController@show');

Route::get('contact','ContactController@index');
//register
//--get
Route::get('register','MemberController@register');
//--post
Route::post('register','MemberController@postregister');

//product
Route::get('product', 'ProductController@index');
Route::get('product/brand/{brandId}', 'ProductController@index');
Route::get('product/{brandId}/{groupId?}', 'ProductController@getProduct');

//news
Route::get('news','NewsController@getNewsList');
Route::get('newsHome','NewsController@getNewsListHome');
Route::get('news/{newsId}','NewsController@getNews');
//search
Route::get('search','SearchController@search');
Route::get('search/{keyword}','SearchController@searchProduct');

//admin
//--get
Route::get('admin/{pageSetting?}','AdminController@getSetting');
Route::get('admin/setting/{page}','AdminController@getPage');
Route::get('admin/setting/catalogue/edit/{id}','AdminController@catalogueEdit');
Route::get('admin/setting/catalogue/add','AdminController@catalogueAdd');
Route::get('admin/setting/member/edit/{id}','AdminController@memberEdit');
Route::get('listmember','AdminController@listmember');
Route::get('admin/setting/zone/index','AdminController@zoneIndex');
Route::get('admin/setting/zone/create','AdminController@zoneCreate');
Route::get('admin/setting/branch/index','AdminController@branchIndex');
//--post
Route::post('postcontact','AdminController@postContact');
Route::post('listmember','AdminController@listmember');
Route::post('zone/create','AdminController@zoneCreate');
Route::post('updatemember/{id}','AdminController@updatemember');
