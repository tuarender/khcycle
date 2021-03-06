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
Route::get('profile','MemberController@profilemember');
Route::get('logout','MemberController@logout');
Route::get('forgotPassword','MemberController@forgotPassword');
Route::get('resetPassword/{token}', 'MemberController@getResetPassword');
Route::post('logout','MemberController@logout');
Route::post('forgotPassword', 'MemberController@postForgotpassword');
Route::post('resetPassword', 'MemberController@postResetPassword');
//Route::post('updatemember/{id}','MemberController@update');


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
Route::get('admin',array('uses'=>'AdminController@index'));
Route::get('admin/home','AdminController@getHome');
Route::get('admin/contact','AdminController@getContact');
Route::get('admin/member','AdminController@getMember');
Route::get('member/{id}','AdminController@memberShow');
Route::get('admin/catalogue','AdminController@getCatalogue');
Route::get('admin/product','AdminController@getBrand');
Route::get('admin/news','AdminController@getNews');
Route::get('admin/product/productOf/{id}','AdminController@getProduct');

Route::get('admin/home/banner','AdminController@getBannerEdit');
Route::get('admin/home/banner/{id?}','AdminController@getBannerEdit');
Route::get('admin/news/news','AdminController@getNewsEdit');
Route::get('admin/news/news/{id?}','AdminController@getNewsEdit');
Route::get('admin/product/brand','AdminController@getBrandEdit');
Route::get('admin/product/brand/{id?}','AdminController@getBrandEdit');
Route::get('admin/product/group','AdminController@getGroupSetting');
Route::get('admin/product/group/{id?}','AdminController@getGroupSettingEdit');
Route::get('admin/product/product/{idBrand}','AdminController@getProductEdit');
Route::get('admin/product/product/{idBrand}/{id?}','AdminController@getProductEdit');
Route::get('admin/setting/catalogue/edit/{id}','AdminController@catalogueEdit');
Route::get('admin/setting/catalogue/add','AdminController@catalogueAdd');
Route::get('admin/setting/member/edit/{id}','AdminController@memberEdit');
Route::get('listmember','AdminController@listmember');
Route::get('admin/setting/zone/index','AdminController@zoneIndex');
Route::get('admin/setting/zone/create','AdminController@zoneCreate');
Route::get('admin/setting/branch/index','AdminController@branchIndex');
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
//add
Route::get('admin/product/addGroupToBrand/{idBrand}/{IdGroup}','AdminController@addGroupToBrand');
//delete
Route::get('admin/home/deleteBanner/{id}','AdminController@deleteBanner');
Route::get('admin/news/deleteNews/{id}','AdminController@deleteNews');
Route::get('admin/product/deleteBrand/{id}','AdminController@deleteBrand');
Route::get('admin/product/deleteProduct/{idBrand}/{id}','AdminController@deleteProduct');
Route::get('admin/product/deleteGroup/{id}','AdminController@deleteGroup');
Route::get('admin/product/removeGroupFromBrand/{idBrand}/{idGroup}','AdminController@deleteGroupFromBrand');
Route::get('member/delete/{id}','AdminController@deleteMember');
//move
Route::get('admin/home/moveBanner/order/{id}/{order}','AdminController@orderBanner');
Route::get('admin/news/moveNews/order/{id}/{order}','AdminController@orderNews');
Route::get('admin/product/moveBrand/order/{id}/{order}','AdminController@orderBrand');
Route::get('admin/product/moveProduct/order/{idBrand}/{id}/{order}','AdminController@orderProduct');
Route::get('admin/catalogue/moveCatalogue/order/{id}/{order}','AdminController@orderCatalogue');
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
Route::post('admin/branch/edit','AdminController@branchAdd');
Route::post('admin/branch/edit/{id}','AdminController@branchUpdate');
Route::post('admin/branch','AdminController@getBranch');
Route::post('admin/news/news','AdminController@newsAdd');
Route::post('admin/news/news/{id}','AdminController@newsUpdate');
Route::post('admin/news/preview','AdminController@newsPreview');
Route::post('admin/news/uploadImage','AdminController@newsUploadImage');
Route::post('admin/product/brand','AdminController@brandAdd');
Route::post('admin/product/brand/{id?}','AdminController@brandUpdate');
Route::post('admin/product/group','AdminController@groupAdd');
Route::post('admin/product/group/{id?}','AdminController@groupUpdate');
Route::post('admin/product/product/','AdminController@productAdd');
Route::post('admin/product/product/{id?}','AdminController@productUpdate');
Route::post('admin/member','AdminController@getMember');
Route::get('excel','AdminController@generateExcel');
Route::get('admin/branch/export','AdminController@generateBranchExcel');
