@extends('layouts.admin')

@section('content')
<div class="min-h-screen w-full">

        @if (session('success'))
            <div class="bg-green-100 text-green-700 border border-green-300 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif


        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">Daftar Produk</h1>
            <a href="{{ route('products.create') }}"
               class="bg-blue-700 hover:bg-indigo-700 text-white text-sm px-3 py-1.5 rounded shadow">
                Tambah Produk
            </a>
        </div>

        <table class="min-w-full">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Nama</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Stok</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Kantin</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $product->id }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $product->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $product->stock }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    Rp{{ number_format($product->price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700">
                                    {{ $product->canteen->name ?? '-' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-700 text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                            Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
        </table>
        
    </div>
</div>
@endsection
