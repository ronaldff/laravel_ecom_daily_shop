<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\OrderController;


/*
|--------------------------------------------------------------------------
| Web Admin Routes
|--------------------------------------------------------------------------
|
*/

// Admin login view and auth Routes start
Route::get('admin',[AdminController::class, 'index'])->name('admin_login');
Route::post('admin/auth',[AdminController::class, 'auth'])->name('admin_auth');
// Admin login view and auth Routes end

// Admin auth middleware
Route::group( ['prefix' => 'admin','middleware' => 'admin_auth'], function() {
    
    // Admin dashboard & logout routes start
    Route::get('dashboard',[AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('logout',[AdminController::class, 'logout'])->name('admin_logout');
    // Admin dashboard & logout routes end

    // Admin categories routes start
    Route::get('category', [CategoryController::class, 'index'])->name("admin_category");
    Route::post('category', [CategoryController::class, 'index'])->name("search_category");
    Route::get('category/downloadPdfCat', [CategoryController::class, 'downloadPdfCat'])->name("downloadPdfCat");
    Route::get('category/manage_category', [CategoryController::class, 'manage_category'])->name("add_category");
    Route::get('category/manage_category/{id}', [CategoryController::class, 'manage_category'])->name("editCat");
    Route::post('category/manage_category_process', [CategoryController::class, 'manage_category_process'])->name("manage_category_process");
    Route::post('category/change_cat_status', [CategoryController::class, 'change_cat_status'])->name("change_cat_status");
    Route::post('category/delete', [CategoryController::class, 'delete'])->name("deletecat");
    Route::post('category/activate', [CategoryController::class, 'activate'])->name("activateAll");
    // Admin categories routes end

    // Admin coupon routes start
    Route::get('coupon',[CouponController::class,'index'])->name('admin_coupon');
    Route::get('coupon/manage_coupon', [CouponController::class, 'manage_coupon'])->name("add_coupon");
    Route::get('coupon/manage_coupon/{id}', [CouponController::class, 'manage_coupon'])->name("editCoupon");
    Route::post('coupon/manage_coupon_process', [CouponController::class, 'manage_coupon_process'])->name("manage_coupon_process");
    Route::post('coupon/change_coupon_status', [CouponController::class, 'change_coupon_status'])->name("change_coupon_status");
    Route::post('coupon/delete', [CouponController::class, 'delete'])->name("deletecoupon");
    // Admin coupon routes end

    // Admin size routes start
    Route::get('size',[SizeController::class,'index'])->name('admin_size');
    Route::get('size/manage_size', [SizeController::class, 'manage_size'])->name("add_size");
    Route::get('size/manage_size/{id}', [SizeController::class, 'manage_size'])->name("editsize");
    Route::post('size/manage_size_process', [SizeController::class, 'manage_size_process'])->name("manage_size_process");
    Route::post('size/change_size_status', [SizeController::class, 'change_size_status'])->name("change_size_status");
    Route::post('size/delete', [SizeController::class, 'delete'])->name("deletesize");
    // Admin size routes end

    // Admin customer routes start
    Route::get('customer',[CustomerController::class,'index'])->name('admin_customer');
    Route::get('customer/manage_customer_process', [CustomerController::class, 'manage_customer_process'])->name("manage_customer_process");
    Route::post('customer/change_customer_status', [CustomerController::class, 'change_customer_status'])->name("change_customer_status");
    Route::post('customer/delete', [CustomerController::class, 'delete'])->name("deletecustomer");
    // Admin customer routes end

    // Admin tax routes start
    Route::get('tax',[TaxController::class,'index'])->name('admin_tax');
    Route::get('tax/manage_tax', [TaxController::class, 'manage_tax'])->name("add_tax");
    Route::get('tax/manage_tax/{id}', [TaxController::class, 'manage_tax'])->name("edittax");
    Route::post('tax/manage_tax_process', [TaxController::class, 'manage_tax_process'])->name("manage_tax_process");
    Route::post('tax/change_tax_status', [TaxController::class, 'change_tax_status'])->name("change_tax_status");
    Route::post('tax/delete', [TaxController::class, 'delete'])->name("deletetax");
    // Admin tax routes end

    // Admin color routes start
    Route::get('color',[ColorController::class,'index'])->name('admin_color');
    Route::get('color/manage_color', [ColorController::class, 'manage_color'])->name("add_color");
    Route::get('color/manage_color/{id}', [ColorController::class, 'manage_color'])->name("editcolor");
    Route::post('color/manage_color_process', [ColorController::class, 'manage_color_process'])->name("manage_color_process");
    Route::post('color/change_color_status', [ColorController::class, 'change_color_status'])->name("change_color_status");
    Route::post('color/delete', [ColorController::class, 'delete'])->name("deletecolor");
    // Admin color routes end

    // Admin brand routes start
    Route::get('brand',[BrandController::class,'index'])->name('admin_brand');
    Route::get('brand/manage_brand', [BrandController::class, 'manage_brand'])->name("add_brand");
    Route::get('brand/manage_brand/{id}', [BrandController::class, 'manage_brand'])->name("editbrand");
    Route::post('brand/manage_brand_process', [BrandController::class, 'manage_brand_process'])->name("manage_brand_process");
    Route::post('brand/change_brand_status', [BrandController::class, 'change_brand_status'])->name("change_brand_status");
    Route::post('brand/delete', [BrandController::class, 'delete'])->name("deletebrand");
    // Admin brand routes end

     // Admin banner routes start
     Route::get('banner',[BannerController::class,'index'])->name('admin_banner');
     Route::get('banner/manage_brand', [BannerController::class, 'manage_banner'])->name("add_banner");
     Route::get('banner/manage_banner/{id}', [BannerController::class, 'manage_banner'])->name("editbanner");
     Route::post('banner/manage_banner_process', [BannerController::class, 'manage_banner_process'])->name("manage_banner_process");
     Route::post('banner/delete', [BannerController::class, 'delete'])->name("deletebrand");
     // Admin banner routes end

    // Admin product routes start
    Route::get('product',[ProductController::class,'index'])->name('admin_product');
    Route::get('product/manage_product', [ProductController::class, 'manage_product'])->name("add_product");
    Route::get('product/manage_product/{id}', [ProductController::class, 'manage_product'])->name("editproduct");
    Route::post('product/manage_product_process', [ProductController::class, 'manage_product_process'])->name("manage_product_process");
    Route::post('product/change_product_status', [ProductController::class, 'change_product_status'])->name("change_product_status");
    Route::post('product/delete', [ProductController::class, 'delete'])->name("deleteproduct");
    Route::post('product/deleteAttr', [ProductController::class, 'deleteAttr'])->name("deleteAttr");
    Route::post('product/deleteMultiImage', [ProductController::class, 'deleteMultiImage'])->name("deleteMultiImage");
    // Admin product routes end

    // Admin orders routes start
    Route::get('order',[OrderController::class, 'index'])->name('admin_order');
    Route::get('order_details/{id}',[OrderController::class, 'order_details'])->name('admin_order_details');
    // Admin orders routes end
    
});

