<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view ('welcome');
});

Route::resource('products', ProductController::class);

Route::get('/home', function () {
    return view('home.index');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');