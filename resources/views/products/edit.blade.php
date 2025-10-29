@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-5">Edit Produk</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-medium mb-1">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                class="w-full border rounded p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block font-medium mb-1">Harga</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                class="w-full border rounded p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Stok</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="border rounded w-full p-2" required>
        </div>


        <div class="mb-4">
            <label for="description" class="block font-medium mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                class="w-full border rounded p-2 focus:ring focus:ring-blue-300">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="canteen_id" class="block font-medium mb-1">Kantin</label>
            <select name="canteen_id" id="canteen_id" class="w-full border rounded p-2 focus:ring focus:ring-blue-300" required>
                @foreach ($canteens as $canteen)
                    <option value="{{ $canteen->id }}" {{ $product->canteen_id == $canteen->id ? 'selected' : '' }}>
                        {{ $canteen->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block font-medium mb-1">Gambar Produk</label>
            <input type="file" name="image" id="image" class="w-full border rounded p-2 mb-2">

            @if ($product->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="Gambar Produk" class="w-32 rounded">
                </div>
            @endif
        </div>

        <div class="text-right">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
