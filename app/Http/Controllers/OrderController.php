<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::all();
        return view('orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'quantities.*' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'total_price' => 0,
            'status' => 'pending'
        ]);

        $total = 0;

        foreach ($request->products as $index => $productId) {
            $product = Product::find($productId);
            $qty = $request->quantities[$index];
            $price = $product->price * $qty;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $qty,
                'price' => $price
            ]);

            $total += $price;
        }

        $order->update(['total_price' => $total]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dihapus!');
    }

    public function edit(Order $order)
    {
        $products = Product::all();
        return view('orders.edit', compact('order', 'products'));
    }

    
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required',
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
            'total_price'   => 'required|numeric|min:0',
        ]);

        $order->update($request->all());

        return redirect()->route('orders.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }
}