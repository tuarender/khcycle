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
Route::get('admin/home','AdminController@getHome');
Route::get('admin/contact','AdminController@getContact');
Route::get('admin/member','AdminController@getMember');
Route::get('admin/catalogue','AdminController@getCatalogue');
Route::get('admin/product','AdminController@getProduct');
Route::get('admin/news','AdminController@getNews');

Route::get('admin/home/banner','AdminController@getBannerEdit');
Route::get('admin/home/banner/{id?}','AdminController@getBannerEdit');
Route::get('admin/setting/catalogue/edit/{id}','AdminController@catalogueEdit');
Route::get('admin/setting/catalogue/add','AdminController@catalogueAdd');
Route::get('admin/setting/member/edit/{id}','AdminController@memberEdit');
Route::get('listmember','AdminController@listmember');
Route::get('admin/catalogue/edit','AdminController@catalogueEdit');
Route::get('admin/catalogue/edit/{id?}','AdminController@catalogueEdit');
Route::get('admin/catalogue/delete/{id}','AdminController@catalogueDelete');
Route::get('admin/zone','AdminController@getZone');
Route::get('admin/zone/edit','AdminController@zoneEdit');
Route::get('admin/zone/edit/{id?}','AdminController@zoneEdit');
Route::get('admin/zone/delete/{id}','AdminController@zoneDelete');
Route::get('admin/branch','AdminController@getBranch');
Route::get('admin/branch/edit','AdminController@branchEdit');
Route::get('admin/branch/edit/{id?}','AdminController@branchEdit');
Route::get('admin/branch/delete/{id}','AdminController@branchDelete');


//--post
Route::post('postcontact','AdminController@postContact');
Route::post('listmember','AdminController@listmember');
Route::post('zone/create','AdminController@zoneCreate');
Route::post('updatemember/{id}','AdminController@updatemember');
Route::post('admin/home/banner','AdminController@bannerAdd');
Route::post('admin/home/banner/{id}','AdminController@bannerUpdate');
Route::post('admin/catalogue/edit','AdminController@catalogueAdd');
Route::post('admin/catalogue/edit/{id}','AdminController@catalogueUpdate');
Route::post('admin/zone/edit','AdminController@zoneAdd');
Route::post('admin/zone/edit/{id}','AdminController@zoneUpdate');
Route::post('admin/branch/edit','AdminController@zoneAdd');
Route::post('admin/branch/edit/{id}','AdminController@zoneUpdate');
