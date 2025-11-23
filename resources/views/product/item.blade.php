@extends('layouts.app')

@section('content')
<div>
    <div class="container mx-auto px-4 py-6 max-w-4xl">
        <!-- Tombol Back -->
        <a href="{{ route ('home')}}" class="inline-flex items-center text-blue-600 mb-6 hover:text-indigo-800 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            <span class="font-bold">Kembali</span>
        </a>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 md:h-full object-cover">
                </div>
                
                <div class="md:w-1/2 p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }} – {{ $product->canteen->name }}</h1>
                    
                    <div class="mb-6">
                        <span class="text-3xl font-bold text-blue-600">{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h2>
                        <p class="text-gray-600">
                            {{ Str::limit($product->description, 60, '...') }}
                        </p>
                    </div>
                    
                    
                    <div class="flex flex-col gap-3">
                        <button id="openOrderModal" class="bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 transition-colors flex-1 flex items-center justify-center">
                            Pesan Sekarang
                        </button>
                        <button id="openCartModal" class="border border-blue-600 text-blue-600 py-3 px-6 rounded-lg font-semibold hover:bg-indigo-50 transition-colors flex-1">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Masukin ke Keranjang
                        </button>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Pop-up Keranjang -->
<div id="cartModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div id="cartModalBackdrop" class="fixed inset-0 bg-black bg-opacity-0 transition-opacity duration-300"></div>
    
    <!-- Modal Content -->
    <div id="cartModalContent" class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0 z-50">

        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-800">Tambah ke Keranjang</h3>
            <button id="closeCartModal" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Konten Modal -->
        <div class="p-6">
            <!-- Informasi Produk -->
            <div class="flex items-center mb-6">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 rounded-lg object-cover">
                <div class="ml-4">
                    <h4 class="font-semibold text-gray-800">{{ $product->name }}</h4>
                    <p class="text-blue-600 font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>
            
            
            <!-- Catatan -->
            <div class="mb-6">
                <label for="cartNotes" class=" font-medium text-gray-800 mb-3">Catatan (opsional):</label>
                <textarea id="cartNotes" rows="3" class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Contoh: Pedas, tanpa timun, dll."></textarea>
            </div>
            
            <!-- Jumlah -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah:</label>
                <div class="flex items-center max-w-xs">
                    <button type="button" id="cartDecrementQty" class="bg-blue-500 text-white hover:bg-indigo-600 h-10 w-10 rounded-l-lg flex items-center justify-center transition-colors">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" id="cartQuantity" value="1" min="1" max="10" 
                           class="h-10 w-16 border-y border-gray-300 text-center focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <button type="button" id="cartIncrementQty" class="bg-blue-500 text-white hover:bg-indigo-600 h-10 w-10 rounded-r-lg flex items-center justify-center transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        

        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button id="cancelCart" class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-400 font-medium">
                Batal
            </button>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" id="cartHiddenQuantity" value="1">
            <button type="submit" id="confirmAddToCart" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-indigo-600 font-medium transition-colors">
                Tambah ke Keranjang
            </button>
            </form>
        </div>
    </div>
</div>

<!-- Pop-up Order/Pesan Sekarang -->
<div id="orderModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Backdrop -->
    <div id="orderModalBackdrop" class="fixed inset-0 bg-black bg-opacity-0 transition-opacity duration-300"></div>
    
    <!-- Modal Content -->
    <div id="orderModalContent" class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0 z-50 max-h-[90vh] overflow-hidden flex flex-col">

        <div class="flex justify-between items-center p-6 border-b border-gray-200 flex-shrink-0">
            <h3 class="text-xl font-bold text-gray-800">Konfirmasi Pesanan</h3>
            <button id="closeOrderModal" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        
        <!-- Konten Modal (Scrollable) -->
        <div class="flex-grow overflow-y-auto">
            <div class="p-6">
                <!-- Informasi Produk -->
                <div class="flex items-center mb-6">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 rounded-lg object-cover">
                    <div class="ml-4">
                        <h4 class="font-semibold text-gray-800">{{ $product->name }}</h4>
                        <p class="text-blue-600 font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
                
                <!-- Detail Pesanan -->
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-semibold text-gray-800 mb-3">Detail Pesanan</h4>
                    
                    <!-- Metode -->
                    <div class="">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Metode:</label>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="orderMethod" value="ditempat" class="orderMethod" checked>
                                <span>Makan di tempat</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="orderMethod" value="delivery" class="orderMethod">
                                <span>Delivery (+ Rp2.000)</span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Catatan -->
                <div class="mb-4">
                    <label for="orderNotes" class="font-medium text-gray-800 mb-3">Catatan (opsional):</label>
                    <textarea id="orderNotes" rows="3" class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Contoh: Pedas, tanpa timun, dll."></textarea>
                </div>
                
                <!-- Jumlah -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah:</label>
                    <div class="flex items-center max-w-xs">
                        <button type="button" id="orderDecrementQty" class="bg-blue-500 text-white hover:bg-indigo-600 h-10 w-10 rounded-l-lg flex items-center justify-center transition-colors">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" id="orderQuantity" value="1" min="1" max="10" 
                               class="h-10 w-16 border-y border-gray-300 text-center focus:outline-none focus:ring-1 focus:ring-blue-500">
                        <button type="button" id="orderIncrementQty" class="bg-blue-500 text-white hover:bg-indigo-600 h-10 w-10 rounded-r-lg flex items-center justify-center transition-colors">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Ringkasan Harga -->
                <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Subtotal:</span>
                        <span id="orderSubtotal" class="font-semibold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Ongkir:</span>
                        <span id="orderDeliveryFee">Rp0</span>
                    </div>
                    <div class="flex justify-between pt-2 border-t border-blue-200">
                        <span class="font-semibold text-gray-800">Total:</span>
                        <span id="orderTotal" class="font-bold text-blue-600">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Modal -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200 flex-shrink-0">
            <button id="cancelOrder" class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:bg-gray-400 font-medium">
                Batal
            </button>
            <form action="{{ route('order.direct') }}" method="POST" id="directOrderForm">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" id="orderHiddenQuantity" value="1">
                <input type="hidden" name="delivery_method" id="orderDeliveryMethod" value="ditempat">
                <input type="hidden" name="order_time" id="orderHiddenTime" value="08:00">
                <input type="hidden" name="notes" id="orderHiddenNotes" value="">
                <button type="submit" id="confirmOrder" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-indigo-600 font-medium transition-colors">
                    Konfirmasi Pesanan
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========== CART MODAL ==========
    // Elemen modal cart
    const cartModal = document.getElementById('cartModal');
    const cartModalBackdrop = document.getElementById('cartModalBackdrop');
    const cartModalContent = document.getElementById('cartModalContent');
    const openCartModalBtn = document.getElementById('openCartModal');
    const closeCartModalBtn = document.getElementById('closeCartModal');
    const cancelCartBtn = document.getElementById('cancelCart');
    
    // Elemen jumlah cart
    const cartQuantityInput = document.getElementById('cartQuantity');
    const cartDecrementQtyBtn = document.getElementById('cartDecrementQty');
    const cartIncrementQtyBtn = document.getElementById('cartIncrementQty');
    const cartHiddenQuantity = document.getElementById('cartHiddenQuantity');
    
    // Membuka modal cart
    openCartModalBtn.addEventListener('click', function() {
        openModal(cartModal, cartModalBackdrop, cartModalContent);
    });
    
    // Menutup modal cart
    function closeCartModal() {
        closeModal(cartModal, cartModalBackdrop, cartModalContent);
    }
    
    closeCartModalBtn.addEventListener('click', closeCartModal);
    cancelCartBtn.addEventListener('click', closeCartModal);
    cartModalBackdrop.addEventListener('click', closeCartModal);
    
    // Mengatur jumlah cart
    cartDecrementQtyBtn.addEventListener('click', function() {
        if (parseInt(cartQuantityInput.value) > 1) {
            cartQuantityInput.value = parseInt(cartQuantityInput.value) - 1;
            cartHiddenQuantity.value = cartQuantityInput.value;
        }
    });
    
    cartIncrementQtyBtn.addEventListener('click', function() {
        if (parseInt(cartQuantityInput.value) < 10) {
            cartQuantityInput.value = parseInt(cartQuantityInput.value) + 1;
            cartHiddenQuantity.value = cartQuantityInput.value;
        }
    });
    
    // Update quantity when input changes
    cartQuantityInput.addEventListener('change', function() {
        if (this.value < 1) this.value = 1;
        if (this.value > 10) this.value = 10;
        cartHiddenQuantity.value = this.value;
    });

    // ========== ORDER MODAL ==========
    // Elemen modal order
    const orderModal = document.getElementById('orderModal');
    const orderModalBackdrop = document.getElementById('orderModalBackdrop');
    const orderModalContent = document.getElementById('orderModalContent');
    const openOrderModalBtn = document.getElementById('openOrderModal');
    const closeOrderModalBtn = document.getElementById('closeOrderModal');
    const cancelOrderBtn = document.getElementById('cancelOrder');
    
    // Elemen jumlah order
    const orderQuantityInput = document.getElementById('orderQuantity');
    const orderDecrementQtyBtn = document.getElementById('orderDecrementQty');
    const orderIncrementQtyBtn = document.getElementById('orderIncrementQty');
    const orderHiddenQuantity = document.getElementById('orderHiddenQuantity');
    
    // Elemen form order
    const orderTimeSelect = document.getElementById('orderTime');
    const orderNotesInput = document.getElementById('orderNotes');
    const orderDeliveryMethodInput = document.getElementById('orderDeliveryMethod');
    const orderHiddenTime = document.getElementById('orderHiddenTime');
    const orderHiddenNotes = document.getElementById('orderHiddenNotes');
    
    // Elemen harga
    const orderSubtotal = document.getElementById('orderSubtotal');
    const orderDeliveryFee = document.getElementById('orderDeliveryFee');
    const orderTotal = document.getElementById('orderTotal');
    
    // Membuka modal order
    openOrderModalBtn.addEventListener('click', function() {
        openModal(orderModal, orderModalBackdrop, orderModalContent);
        updateOrderSummary();
    });
    
    // Menutup modal order
    function closeOrderModal() {
        closeModal(orderModal, orderModalBackdrop, orderModalContent);
    }
    
    closeOrderModalBtn.addEventListener('click', closeOrderModal);
    cancelOrderBtn.addEventListener('click', closeOrderModal);
    orderModalBackdrop.addEventListener('click', closeOrderModal);
    
    // Mengatur jumlah order
    orderDecrementQtyBtn.addEventListener('click', function() {
        if (parseInt(orderQuantityInput.value) > 1) {
            orderQuantityInput.value = parseInt(orderQuantityInput.value) - 1;
            orderHiddenQuantity.value = orderQuantityInput.value;
            updateOrderSummary();
        }
    });
    
    orderIncrementQtyBtn.addEventListener('click', function() {
        if (parseInt(orderQuantityInput.value) < 10) {
            orderQuantityInput.value = parseInt(orderQuantityInput.value) + 1;
            orderHiddenQuantity.value = orderQuantityInput.value;
            updateOrderSummary();
        }
    });
    
    // Update quantity when input changes
    orderQuantityInput.addEventListener('change', function() {
        if (this.value < 1) this.value = 1;
        if (this.value > 10) this.value = 10;
        orderHiddenQuantity.value = this.value;
        updateOrderSummary();
    });

    // Update metode pengiriman
    document.querySelectorAll('.orderMethod').forEach(radio => {
        radio.addEventListener('change', function() {
            orderDeliveryMethodInput.value = this.value;
            updateOrderSummary();
        });
    });

    // Update waktu
    orderTimeSelect.addEventListener('change', function() {
        orderHiddenTime.value = this.value;
    });

    // Update catatan
    orderNotesInput.addEventListener('input', function() {
        orderHiddenNotes.value = this.value;
    });

    // Fungsi update ringkasan pesanan
    function updateOrderSummary() {
        const quantity = parseInt(orderQuantityInput.value);
        const price = {{ $product->price }};
        const isDelivery = document.querySelector('input[name="orderMethod"]:checked').value === 'delivery';
        const deliveryFee = isDelivery ? 2000 : 0;
        
        const subtotal = price * quantity;
        const total = subtotal + deliveryFee;
        
        orderSubtotal.textContent = 'Rp' + subtotal.toLocaleString('id-ID');
        orderDeliveryFee.textContent = 'Rp' + deliveryFee.toLocaleString('id-ID');
        orderTotal.textContent = 'Rp' + total.toLocaleString('id-ID');
    }

    function openModal(modal, backdrop, content) {
        modal.classList.remove('hidden');
        void modal.offsetWidth;

        backdrop.classList.add('bg-opacity-50');
        content.classList.add('scale-100', 'opacity-100');
    }

    function closeModal(modal, backdrop, content) {
        backdrop.classList.remove('bg-opacity-50');
        content.classList.remove('scale-100', 'opacity-100');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }


    updateOrderSummary();
});
</script>
@endsection