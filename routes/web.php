<?php
use Illuminate\Support\Facades\Route;

// Clear cache Routes
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    exec('composer dump-autoload');
    Cache::flush();
    \Cache::flush();
    dd("Cache cleared!");
});

// Admin Routes require
require_once(base_path()."/routes/admin_routes.php");

// Front Routes require
require_once(base_path()."/routes/front_routes.php");



