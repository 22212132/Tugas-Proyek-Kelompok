<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Product;

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

        $delivery_method = $request->input('delivery_place', 'Makan di tempat');
        $delivery_fee = ($delivery_method === 'delivery') ? 2000 : 0;

        $total_price = 0;
        foreach ($carts as $cart) {
            $total_price += $cart->product->price * $cart->quantity;
        }

        $total_price += $delivery_fee;

        if ($user->saldo < $total_price) {
            return redirect()->back()->with('error', 'Saldo kamu tidak cukup untuk melakukan pembayaran!');
        }

        $order = Order::create([
            'user_id' => $user_id,
            'status' => 'delivered',
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
                'delivery_place' => $delivery_method,
            ]);

            $cart->product->stock -= $cart->quantity;
            if ($cart->product->stock < 0) {
                $cart->product->stock = 0;
            }

            $cart->product->save();
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

    public function orderIndex()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function directOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'delivery_method' => 'required|string',
            'order_time' => 'required|string',
            'notes' => 'nullable|string',
            'location' => 'required_if:delivery_method,delivery',
        ]);

        $user = auth()->user() ?? User::find(1);
        $user_id = $user->id;

        // Hitung total - SAMA DENGAN CHECKOUT
        $product = Product::findOrFail($request->product_id);
        $delivery_fee = ($request->delivery_method === 'delivery') ? 2000 : 0;
        
        $total_price = $product->price * $request->quantity;
        $total_price += $delivery_fee;

        // Cek saldo user - SAMA DENGAN CHECKOUT
        if ($user->saldo < $total_price) {
            return redirect()->back()->with('error', 'Saldo kamu tidak cukup untuk melakukan pembayaran!');
        }

        // Cek stok produk
        if ($product->stock < $request->quantity) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi! Stok tersedia: ' . $product->stock);
        }


        $order = Order::create([
            'user_id' => $user_id,
            'status' => 'delivered', 
            'payment_method' => 'cash', 
            'total_price' => $total_price, 
            'delivery_place' => $request->delivery_method === 'delivery' ? 'Delivery' : 'Makan di tempat', 
            'delivery_time' => $request->order_time,
            'notes' => $request->notes,
            'location' => $request->location,
        ]);


        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'delivery_place' => $request->delivery_method === 'delivery' ? 'Delivery' : 'Makan di tempat', 
        ]);

        $product->stock -= $request->quantity;
        if ($product->stock < 0) {
            $product->stock = 0;
        }
        $product->save();
        $user->saldo -= $total_price;
        $user->save();

        Transaction::create([
            'user_id' => $user_id,
            'order_id' => $order->id,
            'type' => 'payment',
            'amount' => $total_price,
        ]);

        return redirect()->route('history')->with('success', 'Pesanan berhasil dibuat dan saldo telah dipotong!');
    }
}