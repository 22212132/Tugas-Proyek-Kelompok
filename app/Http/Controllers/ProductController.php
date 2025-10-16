<?php

namespace App\Http\Controllers;
use App\Models\Canteen;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

    if ($search) {
        $products = \App\Models\Product::where('name', 'like', "%{$search}%")
            ->get();
    } else {
        $products = \App\Models\Product::get();
    }

    return view('products.index', compact('products', 'search'));
    }

    public function create()
    {
        $canteens = Canteen::all();
        return view('products.create', compact('canteens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'canteen_id' => 'required|exists:canteens,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $canteens = Canteen::all();
        return view('products.edit', compact('product', 'canteens'));
    }

    public function update(Request $request, Product $product)
    {
        dd($request->all());
        $request->validate([
            'name'  => 'required',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'canteen_id' => 'required|exists:canteens,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
