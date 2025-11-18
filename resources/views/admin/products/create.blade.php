@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-5">Tambah Produk Baru</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-medium mb-1">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full border rounded p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block font-medium mb-1">Harga</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}"
                class="w-full border rounded p-2 focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Stok</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="border rounded w-full p-2" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block font-medium mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                class="w-full border rounded p-2 focus:ring focus:ring-blue-300">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="canteen_id" class="block font-medium mb-1">Kantin</label>
            <select name="canteen_id" id="canteen_id" class="w-full border rounded p-2 focus:ring focus:ring-blue-300" required>
                <option value="">-- Pilih Kantin --</option>
                @foreach ($canteens as $canteen)
                    <option value="{{ $canteen->id }}" {{ old('canteen_id') == $canteen->id ? 'selected' : '' }}>
                        {{ $canteen->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="image" class="block font-medium mb-1">Gambar Produk</label>
            <input type="file" name="image" id="image" class="w-full border rounded p-2">
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 border border-red-300 p-3 rounded mb-4">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </form>
</div>
@endsection
