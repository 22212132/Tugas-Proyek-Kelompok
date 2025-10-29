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
                    <img src="img/NasiKuning.jpeg"
                         alt="Nasi Kuning" class="w-full h-64 md:h-full object-cover">
                </div>
                
                <div class="md:w-1/2 p-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">Nasi Kuning – Kantin Mama</h1>

                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="text-gray-600">4.8 (265 Reviews)</span>
                    </div>
                    
                    <div class="mb-6">
                        <span class="text-3xl font-bold text-blue-600">Rp15.000</span>
                    </div>
                    
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h2>
                        <p class="text-gray-600">
                            Dibuat dari bahan-bahan pilihan, dimasak fresh setiap hari, serta dikemas higienis sehingga aman dan praktis untuk dinikmati.
                        </p>
                    </div>
                    
                    
                    <div class="flex flex-col gap-3">
                        <a href="" class="bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-indigo-700 transition-colors flex-1 flex items-center justify-center">
                            Pesan Sekarang
                        </a>
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
    <div id="modalBackdrop" class="fixed inset-0 bg-black bg-opacity-0 transition-opacity duration-300"></div>
    
    <!-- Modal Content -->
    <div id="modalContent" class="bg-white rounded-xl shadow-lg max-w-md w-full mx-4 transform transition-all duration-300 scale-95 opacity-0 z-50">

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
                <img src="img/NasiKuning.jpeg" alt="Nasi Kuning" class="w-16 h-16 rounded-lg object-cover">
                <div class="ml-4">
                    <h4 class="font-semibold text-gray-800">Nasi Kuning</h4>
                    <p class="text-blue-600 font-bold">Rp15.000</p>
                </div>
            </div>
            
            
            <!-- Catatan -->
            <div class="mb-6">
                <label for="notes" class=" font-medium text-gray-800 mb-3">Catatan (opsional):</label>
                <textarea id="notes" rows="3" class="w-full px-3 py-2 border border-gray-400 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500" placeholder="Contoh: Pedas, tanpa timun, dll."></textarea>
            </div>
            
            <!-- Jumlah -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah:</label>
                <div class="flex items-center max-w-xs">
                    <button type="button" id="decrementQty" class="bg-blue-500 text-white hover:bg-indigo-600 h-10 w-10 rounded-l-lg flex items-center justify-center transition-colors">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" id="quantity" value="1" min="1" max="10" 
                           class="h-10 w-16 border-y border-gray-300 text-center focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <button type="button" id="incrementQty" class="bg-blue-500 text-white hover:bg-indigo-600 h-10 w-10 rounded-r-lg flex items-center justify-center transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
        

        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button id="cancelCart" class="px-4 py-2 bg-gray-200 text-gray-600 rounded-lg hover:text-gray-800 font-medium">
                Batal
            </button>
            <button id="confirmAddToCart" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-indigo-600 font-medium transition-colors">
                Tambah ke Keranjang
            </button>
        </div>
    </div>
</div>



<script>

    // Elemen modal
    const cartModal = document.getElementById('cartModal');
    const modalBackdrop = document.getElementById('modalBackdrop');
    const modalContent = document.getElementById('modalContent');
    const openCartModalBtn = document.getElementById('openCartModal');
    const closeCartModalBtn = document.getElementById('closeCartModal');
    const cancelCartBtn = document.getElementById('cancelCart');
    const confirmAddToCartBtn = document.getElementById('confirmAddToCart');
    
    // Elemen jumlah
    const quantityInput = document.getElementById('quantity');
    const decrementQtyBtn = document.getElementById('decrementQty');
    const incrementQtyBtn = document.getElementById('incrementQty');
    
    // Membuka modal
    openCartModalBtn.addEventListener('click', function() {
        // Tampilkan modal
        cartModal.classList.remove('hidden');
        void cartModal.offsetWidth;

        modalBackdrop.classList.add('bg-opacity-50');
        modalContent.classList.add('scale-100', 'opacity-100');
    });
    

    function closeModal() {

        modalBackdrop.classList.remove('bg-opacity-50');
        modalContent.classList.remove('scale-100', 'opacity-100');

        setTimeout(() => {
            cartModal.classList.add('hidden');
        }, 300);
    }
    

    closeCartModalBtn.addEventListener('click', closeModal);
    cancelCartBtn.addEventListener('click', closeModal);
    modalBackdrop.addEventListener('click', closeModal);
    
    // Mengatur jumlah
    decrementQtyBtn.addEventListener('click', function() {
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });
    
    incrementQtyBtn.addEventListener('click', function() {
        if (parseInt(quantityInput.value) < 10) {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
    });
    
    // Add to cart
    confirmAddToCartBtn.addEventListener('click', function() {
        const notes = document.getElementById('notes').value;
        const quantity = quantityInput.value;
        
        console.log('Catatan:', notes);
        console.log('Jumlah:', quantity);
        
        // Tutup modal
        closeModal();
        
        // Reset form
        document.getElementById('notes').value = '';
        quantityInput.value = '1';
    });
</script>
@endsection