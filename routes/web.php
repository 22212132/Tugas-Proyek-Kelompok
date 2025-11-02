<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CanteenController;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view ('welcome');
});


Route::resource('products', ProductController::class);
Route::get('/products/{id}/item', [ProductController::class, 'showItem'])->name('products.item');

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Auth
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post')->middleware('guest');

Route::post('/logout', [LogoutController::class,'logout'])->name('logout')->middleware('auth');




Route::get('/profile', function () {
    return view('profile.index');
})->name('profile');


Route::resource('canteens', CanteenController::class);

Route::get('/canteen/{id}', [HomeController::class, 'showCanteen'])->name('canteen.show');
Route::get('/cart', [CartController::class, 'cart'])->name('order.cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');


Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');