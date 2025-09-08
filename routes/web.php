<?php
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view ('welcome');
});


Route::get('/home', function () {
    return view('home.index');
})->name('home');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');