<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user = auth()->user() ?? User::find(1);
        $user_id = $user->id;

        $carts = Cart::with('product')->where('user_id', $user_id)->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }

        $total_price = 0;
        foreach ($carts as $cart) {
            $total_price += $cart->product->price * $cart->quantity;
        }

        if ($user->saldo < $total_price) {
            return redirect()->back()->with('error', 'Saldo kamu tidak cukup untuk melakukan pembayaran!');
        }

        $order = Order::create([
            'user_id' => $user_id,
            'status' => 'pending',
            'payment_method' => $request->input('payment_method', 'cash'),
            'total_price' => $total_price,
            'delivery_place' => $request->input('delivery_place', 'Makan di tempat'),
        ]);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->price,
            ]);
        }

        $user->saldo -= $total_price;
        $user->save();

        Transaction::create([
            'user_id' => $user_id,
            'order_id' => $order->id,
            'type' => 'payment',
            'amount' => $total_price,
        ]);

        Cart::where('user_id', $user_id)->delete();

        return redirect()->route('order.cart')->with('success', 'Pesanan berhasil dibuat dan saldo telah dipotong!');
    }
}