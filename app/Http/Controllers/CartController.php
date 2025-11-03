<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart()
    {
        $carts = Cart::with('product')->where('user_id', auth()->id() ?? 1)->get();
    return view('order.cart', compact('carts'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        Cart::create([
            'user_id' => auth()->id() ?? 1,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('order.cart')->with('success', 'Produk berhasil dimasukkan ke keranjang!');
    }
}