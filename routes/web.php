<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CanteenController;

Route::resource('products', ProductController::class);
Route::get('/products/{id}/item', [ProductController::class, 'showItem'])->name('products.item');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/profile', function () {
    return view('auth.profile');
})->name('profile');


Route::resource('canteens', CanteenController::class);

Route::get('/canteen/{id}', [HomeController::class, 'showCanteen'])->name('canteen.show');
