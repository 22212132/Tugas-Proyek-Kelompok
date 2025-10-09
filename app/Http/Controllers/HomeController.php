<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $products = Product::all(); // ambil semua produk
        return view('home.index', compact('products'));
    }
}
