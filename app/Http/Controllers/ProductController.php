<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Ambil semua produk dari database
        $products = products::all();

        // Kirim ke view
        return view('home.index', compact('Products'));
    }
}


