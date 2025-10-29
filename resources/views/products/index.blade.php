@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto mt-10 px-4">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Produk</h2>
        <a href="{{ route('products.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
            + Tambah Produk
        </a>
    </div>

    <!-- Tampilkan pesan sukses -->
    @if (session('success'))
        <div class="bg-green-100 text-green-700 border border-green-300 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Jika tidak ada produk -->
    @if ($products->isEmpty())
        <div class="text-center text-gray-600 mt-10">
            <p>Tidak ada produk yang tersedia.</p>
        </div>
    @else
        <!-- Grid produk -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-200">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                            Tidak ada gambar
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mt-1">{{ Str::limit($product->description, 60, '...') }}</p>

                        <div class="mt-3">
                            <span class="text-blue-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>

                        <div class="text-sm text-gray-500 mt-1">
                            Stok: {{ $product->stock }}
                        </div>

                        @if ($product->canteen)
                            <div class="text-sm text-gray-500 mt-1">
                                Kantin: {{ $product->canteen->name }}
                            </div>
                        @endif

                        <div class="flex justify-between mt-4">
                            <a href="{{ route('products.edit', $product->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                Edit
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection