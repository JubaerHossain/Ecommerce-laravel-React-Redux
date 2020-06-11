<?php

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['admin'])->prefix('admin')->group(function () {
    //Url ---> admin/dashboard
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('slide', 'AdminController@slides')->name('admin.slides');
    Route::get('add-slide', 'AdminController@add_slide')->name('admin.add_slide');
    Route::post('store-slide', 'AdminController@store_slide')->name('admin.store_slide');
    Route::post('slide-approve/{id}', 'AdminController@adminApproveSlide')->name('adminApproveSlide');
    Route::get('edit-slide/{id}', 'AdminController@edit_slide')->name('admin.edit_slide');
    Route::post('update-slide/{id}', 'AdminController@update_slide')->name('admin.update_slide');
    Route::delete('delete-slide/{id}', 'AdminController@delete_slide')->name('admin.delete_slide');
    Route::get('category', 'CategoryController@adminProductCategory')->name('adminProductCategory');
    Route::post('category', 'CategoryController@postAdminProductCategory')->name('postAdminProductCategory');
    Route::get('category-edit/{id}', 'CategoryController@adminEditCategory')->name('adminEditCategory');
    Route::post('category-update/{id}', 'CategoryController@postCategoryEdit')->name('postCategoryEdit');
    Route::get('color-list', 'AdminController@addcolor')->name('admin.color');
    Route::post('color-store', 'AdminController@storecolor')->name('admin.storecolor');
    Route::delete('color-delete/{id}', 'AdminController@deleteColor')->name('admin.delete');
    Route::get('color-edit/{id}', 'AdminController@editcolor')->name('admin.editcolor');
    Route::get('brand-list', 'AdminController@brand_list')->name('admin.brand_list');
    Route::post('brand-order-edit', 'AdminController@brand_orders')->name('admin.brand_orders');
    Route::post('brand-approve-edit/{id}', 'AdminController@adminApproveBrand')->name('adminApproveBrand');
    Route::delete('brand-delete/{id}', 'AdminController@brand_delete')->name('admin.brand_delete');
    Route::get('brand-edit/{id}', 'AdminController@edit_brand')->name('admin.edit_brand');
    Route::post('brand-update/{id}', 'AdminController@update_brand')->name('admin.update_brand');
    Route::post('brand-add/', 'AdminController@add_brand')->name('admin.add_brand');
    Route::post('user-edit', 'AdminController@user_id')->name('admin.user_id');
    Route::post('color-order-edit', 'AdminController@orders')->name('admin.orders');
    Route::post('color-update/{id}', 'AdminController@updatecolor')->name('admin.updatecolor');
    Route::get('weight-list', 'AdminController@weight')->name('admin.weight');
    Route::post('weight-store', 'AdminController@addWeight')->name('admin.addWeight');
    Route::delete('weight-delete/{id}', 'AdminController@deleteWeight')->name('admin.deleteWeight');
    Route::get('all-product', 'AdminController@adminAllProduct')->name('adminAllProduct');
    Route::get('single-product/{id}', 'AdminController@adminSingleProduct')->name('adminSingleProduct');
    Route::post('adminApproveProd/{id}', 'AdminController@adminApproveProd')->name('adminApproveProd');
    Route::post('message/{id}', 'AdminController@message')->name('admin.message');
    Route::post('message-status/{id}', 'AdminController@message_change')->name('admin.message_change')->where('id', '[0-9]+');
    Route::get('message-inbox/{id}', 'AdminController@message_see')->name('admin.message_see')->where('id', '[0-9]+');
    Route::post('admin-message', 'AdminController@message_send')->name('admin.message_send')->where('id', '[0-9]+');
    Route::get('admin-all-order', 'AdminController@adminAllOrders')->name('adminAllOrders');
    Route::get('edit-order/{id}', 'AdminController@adminOrderEdit')->name('adminOrderEdit')->where('id', '[0-9]+');
    Route::get('change-patment-status/{id}', 'Admin\AdminDashboardController@changePmntStatus')->name('changePmntStatus')->where('id', '[0-9]+');
    Route::get('admin-profile', 'MerchantController@profile')->name('admin.profile');
    Route::delete('delete-product/{id}', 'AdminController@prductDelete')->name('admin.prductDel');

});

//Main page home

Route::get('/products/{name}', 'HomeController@poductDisplay')->name('poductDisplay');
Route::get('/item/{slug}/{dpid?}', 'HomeController@singleProduct')->name('singleProduct')->where('slug', '[A-Za-z0-9\- \_]+')->where('dpid', '[0-9]+');

Route::get('/shopping-cart', 'HomeController@shoppingCart')->name('shoppingCart');
Route::post('/post-shopping-cart/{id}', 'HomeController@postAddtoCart')->name('postAddtoCart')->where('id', '[0-9]+');
Route::get('/delet-product-from-cart/{id}', 'HomeController@deletFromCart')->name('deletFromCart')->where('id', '[0-9]+');
Route::get('/submit-checkout', 'HomeController@submitCheckout')->name('submitCheckout');
Route::get('/checkout', 'HomeController@checkout')->name('checkout');
Route::post('post-checkout', 'HomeController@checkoutOrder')->name('checkoutOrder');
Route::get('order-view/{id}', 'HomeController@orderView')->name('orderView');

Route::get('checkout-order/{id}', 'HomeController@productBuyNow')->name('productBuyNow')->where('id', '[0-9]+');
Route::post('final-order', 'HomeController@checkoutBuyNow')->name('checkoutBuyNow');

/* Route::get('affiliate-login', 'AffiliateController@affiliateLogin')->name('affiliateLogin');
Route::post('affiliate-login', 'AffiliateController@loginAffiliater')->name('loginAffiliater'); */

Route::get('product-search/', 'HomeController@searchProd')->name('searchProd');
Route::get('product-cat-view/{id}', 'HomeController@catView')->name('catView')->where('slug', '[A-Za-z0-9\- \_]+');
Route::get('product-sub-view/{id}', 'HomeController@subView')->name('subView')->where('slug', '[A-Za-z0-9\- \_]+');

Route::middleware(['affiliator'])->prefix('affiliate')->group(function () {
    /* Route::get('dashboard', 'AffiliateController@affHome')->name('affHome');
    Route::get('product-set/{id}', 'AffiliateController@affSingleProduct')->name('affSingleProduct'); */
});
//Route For merchant
Route::middleware(['merchant'])->prefix('merchant')->group(function () {
    //Url ---> merchant/dashboard
    Route::get('dashboard', 'MerchantController@dashboard')->name('merchant.dashboard');
    // Product
    Route::get('products', 'ProductController@index')->name('merchantProductIndex');
    Route::get('products/create', 'ProductController@create')->name('merchantProductCreate');
    Route::post('products', 'ProductController@store')->name('merchantCreateProduct');
    // 
    Route::get('product-edit/{id}/{option?}', 'ProductController@productEdit')->name('merchant.productEdit')->where('id', '[0-9]+');
    Route::post('product-update/{id}', 'ProductController@productUpdate')->name('merchant.productUpdate')->where('id', '[0-9]+');
    Route::post('product-message/{id}', 'MerchantController@message')->name('merchant.message')->where('id', '[0-9]+');
    Route::get('message-inbox/{id}', 'MerchantController@message_see')->name('merchant.message_see')->where('id', '[0-9]+');
    Route::post('marchant-message', 'MerchantController@message_send')->name('merchant.message_send')->where('id', '[0-9]+');
    
    Route::post('product-color', 'ProductController@Pcolor')->name('merchant.Pcolor');
    Route::post('product-image/{id}', 'ProductController@productimage_update')->name('merchant.productimage_update');
    Route::post('product-image-add/{id}', 'ProductController@productimage_add')->name('merchant.productimage_add');
    Route::post('product-color/{id}', 'ProductController@Color')->name('merchant.Color');
    Route::post('product-variation/{id}', 'ProductController@variation')->name('merchant.variation');
    Route::post('product-variation-update/{id}', 'ProductController@variation_update')->name('merchant.variation_update');
    Route::delete('product-image/{id}', 'ProductController@delete_defaultimg')->name('merchant.delete_defaultimg');
    Route::delete('product-color-image/{id}', 'ProductController@delete_Color_img')->name('merchant.delete_Color_img');
    Route::delete('product-variation/{id}', 'ProductController@delete_variation')->name('merchant.delete_variation');
    Route::post('product-size', 'ProductController@psize')->name('merchant.psize');
    Route::get('product-size-delet/{index}', 'ProductController@psizeDelet')->name('merchant.psizeDelet')->where('index', '[0-9]+');
    Route::post('product-property/{id}', 'ProductController@propertyupdate')->name('propertyupdate')->where('id', '[0-9]+');
    Route::delete('deletproduct/{id}', 'ProductController@deletMarProd')->name('deletMarProd')->where('id', '[0-9]+');

    Route::get('orders', 'OrderController@orders')->name('orders');
    Route::get('edit-order/{id}', 'OrderController@orderEdit')->name('orderEdit')->where('id', '[0-9]+');
    Route::get('change-status/{id}', 'OrderController@changeStatus')->name('changeStatus')->where('id', '[0-9]+');

    Route::get('vendor-profile', 'MerchantController@vendorProfile')->name('vendorProfile');
    Route::post('vendor-profile', 'MerchantController@postVendorProfile')->name('postVendorProfile');
    Route::post('vendor-profile-image', 'MerchantController@profile_mage')->name('profile_mage');
    Route::post('vendor-profile-brand', 'MerchantController@brand')->name('merchant.brand');

    Route::get('withdraw', 'MerchantController@vendorWithdraw')->name('vendorWithdraw');
    Route::post('withdraw', 'MerchantController@postVendorWithdraw')->name('postVendorWithdraw');
});

Route::middleware(['auth'])->prefix('customer')->group(function () {
    Route::get('dashboard', function () {
        echo "Testing dashboard";
    });
});
Route::view('/merchant/{path?}', 'home')->where('path', '.+');
Route::view('/{path?}', 'welcome')->where('path', '.+')->name('home.index');