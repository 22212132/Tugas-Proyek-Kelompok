@extends('layouts.app')

@section('content')
<div class="bg-white-100 min-h-screen">
    
    <section class="px-8 py-6">
        <h2 class="text-xl font-bold">Laper? Pesan sini aja!</h2>
        <p class="text-gray-500">Kantin Sekolah Kristen Immanuel</p>
        <div class="flex space-x-2 mt-4">
        @foreach ($canteens as $canteen)
            <div class="w-68 bg-white rounded-xl shadow-md p-4 flex flex-col items-center">
                <a href="{{ route('canteen.show', $canteen->id) }}" class="flex flex-col items-center">
                    <div class="w-24 h-24 overflow-hidden flex items-center justify-center">
                        <img src="{{ asset('storage/' . $canteen->image) }}"
                            alt="{{ $canteen->name }}"
                            class="object-cover">
                    </div>
                    <p class="mt-6 text-sm font-semibold text-center flex justify-center items-center w-full">
                        {{ $canteen->name }}
                    </p>

                </a>
            </div>
        @endforeach


        </div>
    </section>


    <!-- Menu Kantin -->
    <section class="px-8 py-6">
        <h2 class="text-xl font-bold mb-4">Menu Kantin</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="relative p-4">
                        <div class="rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover">
                        </div>
                </div>

                <div class="pb-4 px-4">
                    <p class="text-sm text-gray-500">{{ $product->canteen->name }}</p>
                    <h3 class="font-semibold">{{ $product->name }}</h3>
                    <p class="font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('products.item', $product->id) }}" 
                        class="block mt-3 w-full bg-blue-600 hover:bg-blue-500 text-white py-2 rounded-lg text-center">
                        Pesan
                    </a>
                </div>
                </div>
            @endforeach
        </div>
    </section>

</div>

@endsection
