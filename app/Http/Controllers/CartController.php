<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('user_id', 1)->get();
        return view('order.cart', compact('carts'));
    }
}
