<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes 
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
/* CHATBOT */
Route::match(['get', 'post'], '/botman', 'BotManController@handle');
//Route::get('/botman/tinker', 'BotManController@tinker');

Route::get('chatbot', function(){
    return view('web_widget');
});

Route::get('chatbot/create', function(){
    return view('create_conversation');
});

Route::get('/chatbot/list', ['as' => 'chatbot.list', 'uses' => 'BotManController@index']);

Route::get('/chatbot/list/{id}', ['as' => 'chatbot.show', 'uses' => 'BotManController@show']);

Route::post('/chatbot/create/save', ['as' => 'chatbot.create.save', 'uses' => 'BotManController@saveScript']);

/* AUTH */
Route::get('/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
Route::get('/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('/registers', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister']);
Route::get('/customer-register', ['as' => 'getCustomerRegister', 'uses' => 'Auth\AuthController@getCustomerRegister']);
Route::post('/customer-register', ['as' => 'postCustomerRegister', 'uses' => 'Auth\AuthController@postCustomerRegister']);


/* ADMIN */
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    Route::get('/', ['as' => 'admin.index', 'uses' => 'Backend\BackendController@index']);
    /* Cấu hình website */
    Route::get('/config', ['as' => 'admin.config.index', 'uses' => 'Backend\ConfigController@index']);
    Route::post('/config/update/{config}', ['as' => 'admin.config.update', 'uses' => 'Backend\ConfigController@update']);

    /* Quản lý user */
    Route::get('/user', ['as' => 'admin.user.index', 'uses' => 'Backend\UserController@index']);
    Route::get('/user/create', ['as' => 'admin.user.create', 'uses' => 'Backend\UserController@create']);
    Route::post('/user/store', ['as' => 'admin.user.store', 'uses' => 'Backend\UserController@store']);
    Route::get('/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'Backend\UserController@edit']);
    Route::post('/user/update/{id}', ['as' => 'admin.user.update', 'uses' => 'Backend\UserController@update']);
    Route::delete('/user/delete/{id}', ['as' => 'admin.user.destroy', 'uses' => 'Backend\UserController@destroy']);
    Route::get('/user/{id}/toggle', ['as' => 'admin.user.toggle', 'uses' => 'Backend\UserController@toggle']);

   

    Route::get('/manage', ['as' => 'admin.manage', 'uses' => 'Backend\UserController@adminIndex']); 
    Route::get('/manage/edit/{id}', ['as' => 'admin.manage.edit', 'uses' => 'Backend\UserController@adminEdit']);
    Route::post('/manage/update/{id}', ['as' => 'admin.manage.update', 'uses' => 'Backend\UserController@adminUpdate']);
    Route::get('/manage/create', ['as' => 'admin.manage.create', 'uses' => 'Backend\UserController@adminCreate']);
    Route::post('/manage/store', ['as' => 'admin.manage.store', 'uses' => 'Backend\UserController@adminStore']);
    Route::post('/manage/delete/{id}', ['as' => 'admin.manage.delete', 'uses' => 'Backend\UserController@adminDel']);

      /* Quản lý sản phẩm */
    Route::get('/Products-all', ['as' => 'admin.products.index', 'uses' => 'Backend\ProductsController@index_product']);
    Route::get('/Products-all/Create', ['as' => 'admin.products.create', 'uses' => 'Backend\ProductsController@create']);

    Route::post('/Products-all/store', ['as' => 'admin.products.store', 'uses' => 'Backend\ProductsController@store']);
    Route::get('/Products-all/edit/{id_product}', ['as' => 'admin.products.edit', 'uses' => 'Backend\ProductsController@edit']);
    Route::post('/Products-all/update/{id}', ['as' => 'admin.products.update', 'uses' => 'Backend\ProductsController@update']);
    Route::delete('/Products-all/delete/{id_product}', ['as' => 'admin.products.destroy', 'uses' => 'Backend\ProductsController@destroy_prd']);
    Route::get('/Products-all/{id}/changeStatus/{name}', ['as' => 'admin.products.changeStatus', 'uses' => 'Backend\ProductsController@changeStatus']);
    Route::post('/Products-all/group/toggle', ['as' => 'admin.products.toggleGroup', 'uses' => 'Backend\ProductsController@toggleGroup']);

    Route::post('/Products-all/CreateColor', ['as' => 'admin.products.create_color', 'uses' => 'Backend\ProductsController@create_color']);
    // quản lý sp trong kho
    Route::get('/Products-in-store', ['as' => 'admin.productsInStore.index', 'uses' => 'Backend\ProductsController@indexInStore']);
    Route::get('/Products-in-store/Create', ['as' => 'admin.productsInStore.create', 'uses' => 'Backend\ProductsController@createInStore']);
    Route::post('/Products-in-store/store', ['as' => 'admin.productsInStore.store', 'uses' => 'Backend\ProductsController@storeInStore']);
    Route::get('/Products-in-store/edit/{id_product}', ['as' => 'admin.productsInStore.edit', 'uses' => 'Backend\ProductsController@editInStore']);
    Route::post('/Products-in-store/update/{id}', ['as' => 'admin.productsInStore.update', 'uses' => 'Backend\ProductsController@updateInStore']);
    Route::delete('/Products-in-store/delete/{id_product}/{id_store}', ['as' => 'admin.productsInStore.destroyInStore', 'uses' => 'Backend\ProductsController@destroyInStore']);

    Route::post('/ProductByStore', ['as' => 'admin.products.bystore', 'uses' => 'Backend\ProductsController@ProductByStore']);
    Route::post('/WarehouseTransfer', ['as' => 'admin.products.warehouseTransfer', 'uses' => 'Backend\ProductsController@WarehouseTransfer']);

     /* Quản lý loại ssản phẩm */
    Route::get('/TypeProduct', ['as' => 'admin.typeproduct.index', 'uses' => 'Backend\TypeProductController@index']);
    Route::get('/TypeProduct/Create', ['as' => 'admin.typeproduct.create', 'uses' => 'Backend\TypeProductController@create']);
    Route::post('/TypeProduct/store', ['as' => 'admin.typeproduct.store', 'uses' => 'Backend\TypeProductController@store']);
    Route::get('/TypeProduct/edit/{id}', ['as' => 'admin.typeproduct.edit', 'uses' => 'Backend\TypeProductController@edit']);
    Route::post('/TypeProduct/update/{id}', ['as' => 'admin.typeproduct.update', 'uses' => 'Backend\TypeProductController@update']);
    Route::delete('/TypeProduct/delete/{id}', ['as' => 'admin.typeproduct.destroy', 'uses' => 'Backend\TypeProductController@destroy']);
   
    Route::post('/TypeProduct/group/toggle', ['as' => 'admin.typeproduct.toggleGroup', 'uses' => 'Backend\TypeProductController@toggleGroup']);
    /* Quản lý khách hàng */

    Route::get('/Customer', ['as' => 'admin.customer.index', 'uses' => 'Backend\UserController@listUserIsCustomer']);
    Route::post('/Customer/export', ['as' => 'admin.customer.export', 'uses' => 'Backend\UserController@export']);
    Route::get('/Customer/des', ['as' => 'admin.customer.des', 'uses' => 'Backend\CustomerController@des']);
    Route::get('/Customer/Create', ['as' => 'admin.customer.create', 'uses' => 'Backend\CustomerController@create']);
    Route::post('/Customer/store', ['as' => 'admin.customer.store', 'uses' => 'Backend\CustomerController@store']);
    Route::get('/Customer/edit/{id}', ['as' => 'admin.customer.edit', 'uses' => 'Backend\CustomerController@edit']);
    Route::post('/Customer/update/{id}', ['as' => 'admin.customer.update', 'uses' => 'Backend\CustomerController@update']);
    Route::delete('/Customer/delete/{id}', ['as' => 'admin.customer.destroy', 'uses' => 'Backend\CustomerController@destroy']);
    
    Route::get('/Customer/detail/{id}', ['as' => 'admin.customer.detail', 'uses' => 'Backend\UserController@detail']);
    Route::get('/Customer/{id}/bill', ['as' => 'admin.customer.bill', 'uses' => 'Backend\UserController@bill']);
    Route::get('/Customer/{id}/bill/{id_bill}', ['as' => 'admin.customer.billDetail', 'uses' => 'Backend\CustomerController@billDetail']);
    Route::get('/Customer/{id}/congno', ['as' => 'admin.customer.congno', 'uses' => 'Backend\UserController@congno']);
     /* Quản lý kho */
    Route::get('/Store', ['as' => 'admin.store.index', 'uses' => 'Backend\StoreController@index']);
    Route::get('/Store/Create', ['as' => 'admin.store.create', 'uses' => 'Backend\StoreController@create']);
    Route::post('/Store/postCreate', ['as' => 'admin.store.postCreate', 'uses' => 'Backend\StoreController@postCreate']);
    Route::get('/Store/edit/{id}', ['as' => 'admin.store.edit', 'uses' => 'Backend\StoreController@edit']);
    Route::post('/Store/update/{id}', ['as' => 'admin.store.update', 'uses' => 'Backend\StoreController@update']);
    Route::delete('/Store/delete/{id}', ['as' => 'admin.store.destroy', 'uses' => 'Backend\StoreController@destroy']);
   

    /* Quản lý đơn đơn hàng */
     Route::get('/billAll', ['as' => 'admin.bill.index', 'uses' => 'Backend\BillController@index']);
     Route::get('/bill-filter-1', ['as' => 'admin.bill.index1', 'uses' => 'Backend\BillController@index1']);
     Route::get('/bill-filter-2', ['as' => 'admin.bill.index2', 'uses' => 'Backend\BillController@index2']);
     Route::get('/bill-filter-3', ['as' => 'admin.bill.index3', 'uses' => 'Backend\BillController@index3']);
     Route::get('/bill-filter-4', ['as' => 'admin.bill.index4', 'uses' => 'Backend\BillController@index4']);
    Route::get('/bill-filter-5', ['as' => 'admin.bill.index5', 'uses' => 'Backend\BillController@index5']);
     Route::get('/bill/detail/{id}', ['as' => 'admin.bill.detail', 'uses' => 'Backend\BillController@detail']);

     // xu ly don hang
     Route::get('/accept_bill/{id}', ['as' => 'admin.bill.accept', 'uses' => 'Backend\BillController@accept_bill']);
     Route::get('/print-order/{id}', ['as' => 'admin.bill.print', 'uses' => 'Backend\BillController@print']);
     Route::get('/cancel_bill/{id}', ['as' => 'admin.bill.cancel', 'uses' => 'Backend\BillController@cancel_bill']);
     Route::get('/finish_order/{id}', ['as' => 'admin.bill.finish', 'uses' => 'Backend\BillController@finish_order']);
     Route::post('/package/{id}', ['as' => 'admin.bill.package', 'uses' => 'Backend\BillController@package_order']);


     // quản lý hãng sản phẩm
    Route::get('/manufacturer', ['as' => 'admin.manufacturer.index', 'uses' => 'Backend\ManufacturerController@index']);
    Route::get('/manufacturer/create', ['as' => 'admin.manufacturer.create', 'uses' => 'Backend\ManufacturerController@create']);
    Route::post('/manufacturer/store', ['as' => 'admin.manufacturer.store', 'uses' => 'Backend\ManufacturerController@store']);
    Route::get('/manufacturer/edit/{id}', ['as' => 'admin.manufacturer.edit', 'uses' => 'Backend\ManufacturerController@edit']);
    Route::post('/manufacturer/update/{id}', ['as' => 'admin.manufacturer.update', 'uses' => 'Backend\ManufacturerController@update']);
    Route::delete('/manufacturer/delete/{id}', ['as' => 'admin.manufacturer.destroy', 'uses' => 'Backend\ManufacturerController@destroy']);
    // Quản lý nhà cung câp
     Route::get('/supplier', ['as' => 'admin.supplier.index', 'uses' => 'Backend\SupplierController@index']);
    Route::get('/supplier/create', ['as' => 'admin.supplier.create', 'uses' => 'Backend\SupplierController@create']);
    Route::post('/supplier/store', ['as' => 'admin.supplier.store', 'uses' => 'Backend\SupplierController@store']);
    Route::get('/supplier/edit/{id}', ['as' => 'admin.supplier.edit', 'uses' => 'Backend\SupplierController@edit']);
    Route::post('/supplier/update/{id}', ['as' => 'admin.supplier.update', 'uses' => 'Backend\SupplierController@update']);
    Route::delete('/supplier/delete/{id}', ['as' => 'admin.supplier.destroy', 'uses' => 'Backend\SupplierController@destroy']);
    // Quản lý nhân viên
    Route::get('/staff', ['as' => 'admin.staff.index', 'uses' => 'Backend\StaffController@index']);
    Route::post('/staff/export', ['as' => 'admin.staff.export', 'uses' => 'Backend\StaffController@export']);
  
    Route::get('/staff/Create', ['as' => 'admin.staff.create', 'uses' => 'Backend\StaffController@create']);
    Route::post('/staff/store', ['as' => 'admin.staff.store', 'uses' => 'Backend\StaffController@store']);
    Route::get('/staff/edit/{id}', ['as' => 'admin.staff.edit', 'uses' => 'Backend\StaffController@edit']);
    Route::post('/staff/update/{id}', ['as' => 'admin.staff.update', 'uses' => 'Backend\StaffController@update']);
    Route::delete('/staff/delete/{id}', ['as' => 'admin.staff.destroy', 'uses' => 'Backend\StaffController@destroy']);
     /* Quản lý báo cáo */ 
    Route::get('/report/sales', ['as' => 'admin.report.sales', 'uses' => 'Backend\ReportController@indexSales']);
    Route::get('/report-in-date', ['as' => 'admin.reportInDate', 'uses' => 'Backend\ReportController@reportInDate']);
    Route::get('/report-in-date/pdf', ['as' => 'admin.reportInDate.pdf', 'uses' => 'Backend\ReportController@reportInDatePDF']);
    Route::get('/report/sales/tranfer', ['as' => 'admin.report.tranfer', 'uses' => 'Backend\ReportController@tranfer']);



     Route::get('/report/store', ['as' => 'admin.report.store', 'uses' => 'Backend\ReportController@indexStore']);


     // Quản lý mã giảm giá
    Route::get('/discount-code', ['as' => 'admin.discountcode.index', 'uses' => 'Backend\DiscountCodeController@index']);
    Route::get('/discount-code/Create', ['as' => 'admin.discountcode.create', 'uses' => 'Backend\DiscountCodeController@create']);
    Route::post('/discount-code/store', ['as' => 'admin.discountcode.store', 'uses' => 'Backend\DiscountCodeController@store']);
    Route::delete('/discount-code/delete/{id}', ['as' => 'admin.discountcode.destroy', 'uses' => 'Backend\DiscountCodeController@destroy']);
     Route::post('/discount-code/group/toggle', ['as' => 'admin.discountcode.toggleGroup', 'uses' => 'Backend\DiscountCodeController@toggleGroup']);

   });

            /* front-end */

        
// CUSTOMER //
 Route::group(['middleware' => 'customerLogin'], function() {
    Route::get('/my-product', ['as' => 'customer.myProduct', 'uses' => 'Backend\UserController@myProduct']);
    Route::get('/my-account', ['as' => 'customer.myAccount', 'uses' => 'Backend\UserController@myAccount']);
    Route::get('/my-order', ['as' => 'customer.myOrder', 'uses' => 'Backend\UserController@myOrder']);
    Route::get('/my-order-detail/{id_order}', ['as' => 'customer.myOrderDetail', 'uses' => 'Backend\UserController@myOrderDetail']);
    // check out
    Route::get('/check-out', ['as' => 'customer.checkout', 'uses' => 'Frontend\CartController@getCheckout']);
    Route::post('/check-out', ['as' => 'customer.postCheckout', 'uses' => 'Frontend\CartController@postCheckout']);



});

Route::get('/', ['as' => 'home', 'uses' => 'Frontend\HomepageController@index']);
Route::get('/product/{id}', ['as' => 'productDetail', 'uses' => 'Frontend\HomepageController@view_product']);
Route::get('/checkout', ['as' => 'checkout', 'uses' => 'Frontend\HomepageController@checkout']);
// cart
Route::get('/addToCart/{id_product}', ['as' => 'addToCart', 'uses' => 'Frontend\CartController@addToCart']);

Route::get('/cart', ['as' => 'cart', 'uses' => 'Frontend\CartController@cart']);
Route::get('/delProductInCart/{id}', ['as' => 'delProductInCart', 'uses' => 'Frontend\CartController@delProductInCart']);
Route::get('/updateCart/{id}/{qty}', ['as' => 'updateCart', 'uses' => 'Frontend\CartController@updateCart']);


Route::get('/category-product/{id}/{id_gender}', ['as' => 'categoryProduct_type', 'uses' => 'Frontend\HomepageController@categoryProduct_type']); 
Route::get('/category-new-products', ['as' => 'category_new_products', 'uses' => 'Frontend\HomepageController@new_products']);
Route::get('/products-is-highly-appreciated', ['as' => 'product_is_highly_appreciated', 'uses' => 'Frontend\HomepageController@product_is_highly_appreciated']);

Route::get('/search', ['as' => 'search', 'uses' => 'Frontend\HomepageController@search']);
Route::get('/slide-1', ['as' => 'slide_1', 'uses' => 'Frontend\HomepageController@slide_1']);
Route::get('/slide-2', ['as' => 'silde_2', 'uses' => 'Frontend\HomepageController@slide_2']);
Route::get('/slide-3', ['as' => 'silde_3', 'uses' => 'Frontend\HomepageController@slide_3']);
//Đăng ký



/* login with google */
Route::get('login/google',['as' => 'login.google', 'uses' =>  'Auth\AuthController@redirectToProvider']);
Route::get('login/google/callback',['as' => 'login.google.callback', 'uses' => 'Auth\AuthController@handleProviderCallback'] );



/* API */
Route::group(['prefix' => 'api'], function() {


  Route::post('/getNumber', 'Backend\ProductsController@getNumber');
  Route::post('/addSP', 'Backend\ProductsController@add');
  Route::post('/getSizeAndColor', 'Backend\ProductsController@getSizeAndColor');
  Route::post('/addSizeOrColor', 'Backend\ProductsController@addSizeOrColor');
  Route::post('/getCounty', 'Frontend\CartController@getCounty');
  Route::post('/getWard', 'Frontend\CartController@getWard');
  Route::get('/addColor', 'Backend\ProductsController@addColor');
  Route::post('/changeProduct', 'Backend\ProductsController@changeProduct');

  Route::post('/changeColorGetImg', 'Backend\ProductsController@changeColorGetImg');
  Route::post('/view-detail', 'Backend\ReportController@view_detail');
  Route::post('/get-ordered', 'Backend\ReportController@get_ordered');
  Route::post('/view_product', 'Frontend\CartController@view_product');
  Route::post('/get_list_img', 'Frontend\CartController@get_list_img');
  Route::post('/ajaxAddToCart', 'Frontend\CartController@ajaxAddToCart');
  Route::post('/post_ship_cost', 'Frontend\CartController@post_ship_cost');
  Route::post('/apply_coupon', 'Frontend\CartController@apply_coupon');
  Route::post('/add-to-whish-list', 'Frontend\HomepageController@addToWishList');
  Route::post('/delete-in-wishlist', 'Frontend\HomepageController@deleteInWishlist');
  Route::post('/cancel_order', 'Backend\BillController@cancel_order');
  Route::post('/search_group', 'Frontend\HomepageController@search_group');
  Route::post('/register_email', 'Frontend\MailController@register');
  Route::post('/send_rating', 'Frontend\HomepageController@send_rating');
  Route::get('/get_menu_male', 'Frontend\HomepageController@get_menu_male');
  Route::get('/get_menu_female', 'Frontend\HomepageController@get_menu_female');
  // Route::get('/get_silde', 'Frontend\HomepageController@get_silde');
  Route::post('/returns', 'Frontend\HomepageController@returns');
  });
//ajax
