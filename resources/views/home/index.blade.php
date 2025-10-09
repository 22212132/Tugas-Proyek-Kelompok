@extends('layouts.app')

@section('content')
<div class="bg-sky-100 min-h-screen">
    <!-- Headers -->
    <header class="bg-sky-900 text-white px-6 py-3 flex items-center justify-between shadow-md">
        <div class="flex items-center space-x-3">
            <img src="logo/logo-mono.png" alt="Logo" class="w-5 h-5">
            <span class="font-bold text-lg">Laper.in</span>
        </div>
        <div class="flex items-center space-x-2 w-1/2">
                <input type="text" name="search" placeholder="Cari produk ..."
                        class="w-full px-3 py-2 rounded-lg focus:outline-none text-gray-800">

            <button class="bg-sky-700 hover:bg-sky-800 px-4 py-2 rounded-lg">Pesan</button>
        </div>
    </header>

    <!-- Banner -->
    <section class="px-8 py-6">
        <h2 class="text-xl font-bold">Laper? Pesan sini aja!</h2>
        <p class="text-gray-500">Kantin Sekolah Kristen Immanuel</p>
        <div class="flex space-x-4 mt-4 overflow-x-auto">
            @for($i = 0; $i < 5; $i++)
                <div class="flex-shrink-0 w-32 bg-white rounded-xl shadow-md p-3 flex flex-col items-center">
                    <img src="/images/kantin.png" alt="Kantin Mama" class="w-20 h-20">
                    <p class="mt-2 font-medium">KANTIN MAMA</p>
                </div>
            @endfor
        </div>
    </section>

    <!-- Menu Kantin -->
    <section class="px-8 py-6">
        <h2 class="text-xl font-bold mb-4">Menu Kantin</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <p class="text-sm text-gray-500">Kantin Mama</p>
                        <h3 class="font-semibold">{{ $product->name }}</h3>
                        <p class="text-sky-600 font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <button class="mt-3 w-full bg-sky-500 hover:bg-sky-600 text-white py-2 rounded-lg">
                            Pesan
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
