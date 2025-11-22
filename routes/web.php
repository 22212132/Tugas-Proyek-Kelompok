<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CanteenController;
use App\Http\Controllers\OrderController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view ('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post')->middleware('guest');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class,'logout'])->name('logout')->middleware('auth');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update_password');
    Route::delete('/profile/photo', [ProfileController::class, 'removeProfilePhoto'])->name('profile.remove_photo');

    Route::get('/profile/saldo', [ProfileController::class, 'saldo'])->name('saldo');
    Route::get('/profile/history', [HistoryController::class, 'history'])->name('history');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('edit');

    Route::get('/orders', [OrderController::class, 'orderIndex'])->name('orders.index');
});



Route::resource('products', ProductController::class);
Route::get('/products/{id}/item', [ProductController::class, 'showItem'])->name('products.item');
 
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/favorite', function () {
    return view('order.favorite');
})->name('favorite');

Route::resource('canteens', CanteenController::class);
Route::get('/canteen/{id}', [HomeController::class, 'showCanteen'])->name('canteen.show');


Route::get('/cart', [CartController::class, 'cart'])->name('order.cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');


Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::delete('/user/delete', [UserController::class, 'destroy'])->name('user.delete');
Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
