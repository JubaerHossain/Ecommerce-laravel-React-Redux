<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('sliders', 'AdminController@sliderImages');

Route::post('getMacId', 'MacidController@getMacId');
Route::post('setMacId', 'MacidController@setMacId');
Route::post('updateMerchantId', 'MacidController@updateMerchantId');

Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');
Route::get('merchant-warehouses', 'ProductController@apiOfflineMerchants');
Route::get('merchant-warehouse', 'ProductController@apiOfflineMerchant');


Route::get('andro-merchant-warehouses/', 'AndroidController@apiOfflineMerchants');
Route::get('andro-get-products/{macid}', 'AndroidController@apiALLProduct')->where('macid', '[A-Za-z0-9\:\- \_]+');
Route::get('central-product', 'AndroidController@central_product');
Route::get('andro-get-searched-products/{macid}/{query}', 'AndroidController@apiSearchProduct')->where('query', '[A-Za-z0-9\- \_]+')->where('macid', '[A-Za-z0-9\:\- \_]+');
Route::get('andro-get-product/{macid}/{slug}', 'AndroidController@getProduct')->where('slug', '[A-Za-z0-9\- \_]+')->where('macid', '[A-Za-z0-9\:\- \_]+');
Route::get('andro-get-categories/{macid}/{string}', 'AndroidController@categoryProduct')->where('name', '[A-Za-z0-9\,]+')->where('macid', '[A-Za-z0-9\:\- \_]+');

Route::get('get-products', 'ProductController@apiALLProduct');
Route::get('get-discount-products', 'ProductController@api_Dis_Product');
Route::get('get-category-products/{slug}', 'ProductController@api_cat_Product');

Route::get('get-searched-products/{query}', 'ProductController@apiSearchProduct')->where('query', '[A-Za-z0-9\- \_]+');
Route::get('get-product/{slug}/{id?}', 'ProductController@getProduct')->where('slug', '[A-Za-z0-9\- \_]+');
Route::get('get-categories', 'CategoryController@apiALLCategory');
Route::get('get-categories/{string}', 'CategoryController@categoryProduct')->where('string', '[A-Za-z0-9\,\-\_]+');

Route::get('get-proCategory', 'CategoryController@proCategory');

Route::post('set-order', 'OrderController@apiOrderSubmit');

Route::get('get-division', 'PlaceController@apiDivisions');
Route::get('get-district/{name}', 'PlaceController@apiDistricts')->where('name', '[A-Za-z0-9\- \_]+');


Route::group(['middleware' => 'auth:api'], function(){
	Route::group(['middleware' => 'admin'], function(){
		// Middlewared Routes
	});
	Route::group(['middleware' => 'merchant'], function(){
		// Middlewared Routes
	});
	Route::group(['middleware' => 'affiliator'], function(){
		Route::get('get-dashboard', 'CustomerController@getDashboard');
		Route::get('get-dm', 'CustomerController@apiGetAffiliators');
		Route::get('/transfer', 'CustomerController@transferBalance');
		Route::get('/getTransfer', 'CustomerController@getTransfer');
	});
	Route::post('set-user-id', 'CustomerController@setUserId');
	Route::get('get-profile', 'CustomerController@customerProfile');
	Route::post('update-profile', 'CustomerController@customerUpdateProfile');
	Route::get('delete-storage', 'ProductController@delete_storage');
	Route::get('storage', 'ProductController@allstorage');
	Route::post('update-storage', 'ProductController@storage');
});