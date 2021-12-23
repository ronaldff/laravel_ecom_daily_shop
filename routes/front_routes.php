<?php
use App\Http\Controllers\Front\FrontController;

Route::get('/',[FrontController::class, 'index'])->name('home');
Route::get('product/{slug}',[FrontController::class, 'product'])->name('product_details');
Route::get('category/{slug}',[FrontController::class, 'category'])->name('category_details');
Route::post('add_to_cart',[FrontController::class, 'add_to_cart'])->name('add_to_cart');
Route::get('cart',[FrontController::class, 'cart'])->name('cart');
Route::post('deleteProductFromCart',[FrontController::class, 'deleteProductFromCart'])->name('deleteProductFromCart');
Route::get('checkout',[FrontController::class, 'checkout'])->name('checkout');
Route::get('search/{text}', [FrontController::class, 'search'])->name('search');
Route::get('registration', [FrontController::class, 'registration'])->name('registration');
Route::post('registartion_process', [FrontController::class, 'registartion_process'])->name('registartion_process');
Route::post('login_process', [FrontController::class, 'login_process'])->name('login_process');
Route::get('logout',[FrontController::class, 'logout'])->name('front_logout');
Route::get('/verification/{id}', [FrontController::class, 'verification'])->name('verification');
Route::post('forgot_password', [FrontController::class, 'forgot_password'])->name('forgot_password');
Route::get('/forgot_new_password/{id}', [FrontController::class, 'forgot_new_password'])->name('forgot_new_password');
Route::post('new_password', [FrontController::class, 'new_password'])->name('new_password');
Route::post('coupon_code', [FrontController::class, 'coupon_code'])->name('coupon_code');
Route::post('placeorder', [FrontController::class, 'placeorder'])->name('placeorder');
Route::get('order_placed', [FrontController::class, 'order_placed'])->name('order_placed');
Route::get('order_fail', [FrontController::class, 'order_fail'])->name('order_fail');
Route::get('instamojo_payment_redirect', [FrontController::class, 'instamojo_payment_redirect'])->name('instamojo_payment_redirect');
Route::get('/downloadOrdersPdf/{id}', [FrontController::class, 'downloadOrdersPdf'])->name("downloadOrdersPdf");


Route::group(['middleware' => 'user_auth'], function(){
  Route::get('order',[FrontController::class, 'order'])->name('order');
  Route::get('/order_details/{id}',[FrontController::class, 'order_details'])->name('order_details');
});








