<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user_id = auth()->id() ?? 1; // sementara gunakan user id 1
        $carts = Cart::with('product')->where('user_id', $user_id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }

        // Hitung total harga
        $total_price = 0;
        foreach ($carts as $cart) {
            $total_price += $cart->product->price * $cart->quantity;
        }

        // Simpan ke tabel orders
        $order = Order::create([
            'user_id' => $user_id,
            'status' => 'pending',
            'payment_method' => $request->input('payment_method', 'cash'),
            'total_price' => $total_price,
            'delivery_place' => $request->input('delivery_place', 'Makan di tempat'),
        ]);

        // Simpan setiap item ke order_items
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        // Buat transaksi
        Transaction::create([
            'user_id' => $user_id,
            'order_id' => $order->id,
            'type' => 'payment',
            'amount' => $total_price,
        ]);

        // Hapus keranjang setelah checkout
        Cart::where('user_id', $user_id)->delete();

        return redirect()->route('order.cart')->with('success', 'Pesanan berhasil dibuat!');
    }
}
