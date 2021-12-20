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




