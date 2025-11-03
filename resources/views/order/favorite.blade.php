@extends('layouts.app')

@section('title', 'Favorites')

@section('content')
<div class="bg-gray-50 min-h-screen">

    <!-- Header -->
    <section class="px-8 py-6 bg-white border-b">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Favorit</h1>
        <p class="text-gray-500">Menu favorit dari kantin sekolah</p>
    </section>

    <!-- Favorite List -->
    <section class="px-8 py-6">

        @if(isset($products) && $products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden relative">
                    
                    <button class="absolute top-3 right-3 bg-white p-2 rounded-full shadow-md hover:scale-110 transition">
                        <i class="fas fa-heart text-red-500"></i>
                    </button>

                    <div class="relative p-4">
                        <div class="rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-40 object-cover">
                        </div>
                    </div>

                    <div class="pb-4 px-4">
                        
                        <p class="text-sm text-gray-500">{{ $product->canteen->name ?? 'Tanpa Kantin' }}</p>
                        <h3 class="font-semibold">{{ $product->name }}</h3>
                        <p class="font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <button class="mt-3 w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg transition">
                            Pesan Lagi
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-heart text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-medium text-gray-700 mb-2">Belum ada produk favorit</h3>
            <p class="text-gray-500 mb-6">Tambahkan menu kesukaanmu dari halaman utama</p>
            <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">
                Jelajahi Menu
            </a>
        </div>
        @endif
    </section>
</div>
@endsection

@push('scripts')
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.fa-heart').forEach(icon => {
            icon.addEventListener('click', function() {
                if (this.classList.contains('text-red-500')) {
                    this.classList.remove('text-red-500');
                    this.classList.add('text-gray-400');
                } else {
                    this.classList.add('text-red-500');
                    this.classList.remove('text-gray-400');
                }
            });
        });
    });
</script>
@endpush
