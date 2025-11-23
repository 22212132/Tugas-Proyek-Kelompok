@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')

@if (session('success'))
    <div class="bg-green-100 text-green-700 border border-green-300 p-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-700 border border-red-300 p-3 rounded mb-6">
        {{ session('error') }}
    </div>
@endif

<div class="flex justify-between gap-6 m-5 mt-8">

    <!-- Cart Table -->
    <div class="w-2/3">
        <h4 class="text-3xl font-bold mb-6">Keranjang</h4>

        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="w-full">
                <div class="flex items-center space-x-2 p-4 bg-gray-50 border-b">
                    <input type="checkbox" id="select-all" class="w-4 h-4 text-blue-800 rounded">
                    <label for="select-all" class="text-sm font-medium">Pilih Semua</label>
                </div>
                <thead class="bg-gray-100">
                    <tr class="text-center">
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Pilih</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Produk</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Harga</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Jumlah</th>
                        <th class="px-4 py-2 text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($carts as $cart)
                    <tr class="border-b hover:bg-gray-50 cart-item"
                        data-id="{{ $cart->id }}"
                        data-name="{{ $cart->product->name }}"
                        data-price="{{ $cart->product->price }}"
                        data-quantity="{{ $cart->quantity }}"
                        data-total="{{ $cart->product->price * $cart->quantity }}">
                        <td class="p-4 text-center">
                            <input type="checkbox" class="w-4 h-4 text-blue-800 rounded select-item" checked 
                                   data-id="{{ $cart->id }}"
                                   data-name="{{ $cart->product->name }}"
                                   data-price="{{ $cart->product->price }}"
                                   data-quantity="{{ $cart->quantity }}">
                        </td>
                        <td class="p-4 flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $cart->product->image) }}"
                                 class="w-16 h-16 object-cover rounded-lg bg-gray-200">
                            <div>
                                <span class="font-medium">{{ $cart->product->name }}</span>
                                <p class="text-sm text-gray-500">{{ Str::limit($cart->product->description, 60, '...') }}</p>
                            </div>
                        </td>
                        <td class="p-4 font-semibold price-text">Rp {{ number_format($cart->product->price, 0, ',', '.') }}</td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300 decrease" 
                                        data-id="{{ $cart->id }}">-</button>
                                <span class="w-12 text-center font-medium quantity">{{ $cart->quantity }}</span>
                                <button class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300 increase"
                                        data-id="{{ $cart->id }}">+</button>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <button class="text-red-600 font-medium delete-item" data-id="{{ $cart->id }}">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ringkasan Pesanan -->
    <div class="w-1/3">
        <div class="bg-white rounded-2xl shadow p-6 sticky top-6">
            <h3 class="text-2xl font-bold mb-6">Ringkasan Pesanan</h3>

            <div id="ringkasan" class="space-y-4 mb-6">
                @foreach ($carts as $cart)
                <div class="flex justify-between items-center selected-item" data-id="{{ $cart->id }}">
                    <div>
                        <span class="font-medium">{{ $cart->product->name }}</span>
                        <p class="text-sm text-gray-500">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                    </div>
                    <span class="font-semibold item-total">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>

            <div class="space-y-2 mb-6 ">
                <p class="font-semibold">Pilih Metode:</p>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="metode" value="ditempat" class="metode" checked>
                    <span>Makan di tempat</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="metode" value="delivery" class="metode">
                    <span>Delivery (+ Rp2.000)</span>
                </label>
            </div>

            <!-- Jam -->
            <div class="mb-6 relative">
                <label class="block font-semibold mb-2">Jam Pengantaran / Makan</label>
                <input 
                    type="text" 
                    id="jam" 
                    readonly 
                    placeholder="Pilih Jam"
                    class="border border-gray-300 rounded-lg w-full px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300 cursor-pointer"
                >
                <div id="jam-popup" class="absolute z-10 mt-1 bg-white border border-gray-300 rounded-lg shadow-lg w-full max-h-60 overflow-y-auto hidden">
                    <!-- Options akan diisi oleh JavaScript -->
                </div>
            </div>

            <hr class="my-4">

            <div class="space-y-2 mb-4">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span id="subtotal" class="font-semibold">Rp {{ number_format($carts->sum(function($cart) { return $cart->product->price * $cart->quantity; }), 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkir</span>
                    <span id="ongkir">Rp0</span>
                </div>
            </div>

            <hr class="my-4">

            <div class="flex justify-between text-lg font-bold mb-6">
                <span>Total</span>
                <span id="total">Rp {{ number_format($carts->sum(function($cart) { return $cart->product->price * $cart->quantity; }), 0, ',', '.') }}</span>
            </div>

            <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
                @csrf
                <input type="hidden" name="payment_method" value="cash">
                <input type="hidden" id="delivery_place" name="delivery_place" value="Makan di tempat">
                <input type="hidden" id="selected_items" name="selected_items" value="">
                <button type="submit" class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 disabled:bg-gray-400 disabled:cursor-not-allowed" id="checkout-btn">
                    Lanjutkan Pembayaran
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi variabel
    let selectedItems = new Set(Array.from(document.querySelectorAll('.select-item:checked')).map(cb => cb.dataset.id));
    const selectAllCheckbox = document.getElementById('select-all');
    const checkoutBtn = document.getElementById('checkout-btn');
    const selectedItemsInput = document.getElementById('selected_items');

    // Update selected items input
    function updateSelectedItems() {
        selectedItemsInput.value = Array.from(selectedItems).join(',');
        checkoutBtn.disabled = selectedItems.size === 0;
    }

    // Fungsi untuk update ringkasan
    function updateRingkasan() {
        const ringkasanContainer = document.getElementById('ringkasan');
        const subtotalElement = document.getElementById('subtotal');
        const totalElement = document.getElementById('total');
        
        let subtotal = 0;
        
        // Kosongkan ringkasan
        ringkasanContainer.innerHTML = '';
        
        // Update ringkasan berdasarkan item yang dipilih
        document.querySelectorAll('.select-item:checked').forEach(checkbox => {
            const itemId = checkbox.dataset.id;
            const itemRow = checkbox.closest('.cart-item');
            const quantity = parseInt(itemRow.querySelector('.quantity').textContent);
            const price = parseInt(checkbox.dataset.price);
            const itemTotal = price * quantity;
            
            subtotal += itemTotal;
            
            // Tambahkan item ke ringkasan
            const itemElement = document.createElement('div');
            itemElement.className = 'flex justify-between items-center selected-item';
            itemElement.dataset.id = itemId;
            itemElement.innerHTML = `
                <div>
                    <span class="font-medium">${checkbox.dataset.name}</span>
                    <p class="text-sm text-gray-500">${quantity} x Rp ${price.toLocaleString('id-ID')}</p>
                </div>
                <span class="font-semibold item-total">Rp ${itemTotal.toLocaleString('id-ID')}</span>
            `;
            ringkasanContainer.appendChild(itemElement);
        });
        
        // Update subtotal dan total
        const ongkir = document.querySelector('input[name="metode"]:checked').value === 'delivery' ? 2000 : 0;
        const total = subtotal + ongkir;
        
        subtotalElement.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
        document.getElementById('ongkir').textContent = `Rp ${ongkir.toLocaleString('id-ID')}`;
        totalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
    }

    // Select All functionality
    selectAllCheckbox.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.select-item');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            if (this.checked) {
                selectedItems.add(checkbox.dataset.id);
            } else {
                selectedItems.delete(checkbox.dataset.id);
            }
        });
        updateSelectedItems();
        updateRingkasan();
    });

    // Individual item selection
    document.querySelectorAll('.select-item').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                selectedItems.add(this.dataset.id);
            } else {
                selectedItems.delete(this.dataset.id);
                selectAllCheckbox.checked = false;
            }
            updateSelectedItems();
            updateRingkasan();
        });
    });

    // Delete item functionality
    document.querySelectorAll('.delete-item').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.id;
            if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                // Kirim request DELETE ke server
                fetch(`/cart/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hapus item dari DOM
                        const itemRow = document.querySelector(`.cart-item[data-id="${itemId}"]`);
                        if (itemRow) {
                            itemRow.remove();
                        }
                        
                        // Hapus dari selected items
                        selectedItems.delete(itemId);
                        updateSelectedItems();
                        updateRingkasan();
                        
                        // Update select all checkbox
                        const remainingCheckboxes = document.querySelectorAll('.select-item');
                        selectAllCheckbox.checked = remainingCheckboxes.length > 0 && 
                            remainingCheckboxes.length === document.querySelectorAll('.select-item:checked').length;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus item');
                });
            }
        });
    });

    // Increase quantity
    document.querySelectorAll('.increase').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.id;
            const quantityElement = this.parentElement.querySelector('.quantity');
            let quantity = parseInt(quantityElement.textContent);
            
            quantity++;
            quantityElement.textContent = quantity;
            
            // Update di checkbox data attribute
            const checkbox = document.querySelector(`.select-item[data-id="${itemId}"]`);
            if (checkbox) {
                checkbox.dataset.quantity = quantity;
            }
            
            // Update total di row
            const price = parseInt(checkbox.dataset.price);
            const itemRow = this.closest('.cart-item');
            itemRow.dataset.quantity = quantity;
            itemRow.dataset.total = price * quantity;
            
            // Update quantity di server (optional)
            updateQuantityOnServer(itemId, quantity);
            
            updateRingkasan();
        });
    });

    // Decrease quantity
    document.querySelectorAll('.decrease').forEach(button => {
        button.addEventListener('click', function() {
            const itemId = this.dataset.id;
            const quantityElement = this.parentElement.querySelector('.quantity');
            let quantity = parseInt(quantityElement.textContent);
            
            if (quantity > 1) {
                quantity--;
                quantityElement.textContent = quantity;
                
                // Update di checkbox data attribute
                const checkbox = document.querySelector(`.select-item[data-id="${itemId}"]`);
                if (checkbox) {
                    checkbox.dataset.quantity = quantity;
                }
                
                // Update total di row
                const price = parseInt(checkbox.dataset.price);
                const itemRow = this.closest('.cart-item');
                itemRow.dataset.quantity = quantity;
                itemRow.dataset.total = price * quantity;
                
                // Update quantity di server (optional)
                updateQuantityOnServer(itemId, quantity);
                
                updateRingkasan();
            }
        });
    });

    // Update metode pengiriman
    document.querySelectorAll('.metode').forEach(radio => {
        radio.addEventListener('change', function() {
            const deliveryPlace = document.getElementById('delivery_place');
            if (this.value === 'delivery') {
                deliveryPlace.value = 'Delivery';
            } else {
                deliveryPlace.value = 'Makan di tempat';
            }
            updateRingkasan();
        });
    });

    // Fungsi untuk update quantity di server
    function updateQuantityOnServer(itemId, quantity) {
        fetch(`/cart/${itemId}`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ quantity: quantity })
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error('Failed to update quantity');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // Jam functionality (placeholder)
    const jamInput = document.getElementById('jam');
    const jamPopup = document.getElementById('jam-popup');
    
    jamInput.addEventListener('click', function() {
        // Contoh jam yang tersedia
        const jamTersedia = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
        
        jamPopup.innerHTML = '';
        jamTersedia.forEach(jam => {
            const div = document.createElement('div');
            div.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer';
            div.textContent = jam;
            div.addEventListener('click', function() {
                jamInput.value = jam;
                jamPopup.classList.add('hidden');
            });
            jamPopup.appendChild(div);
        });
        
        jamPopup.classList.toggle('hidden');
    });

    // Close jam popup when clicking outside
    document.addEventListener('click', function(e) {
        if (!jamInput.contains(e.target) && !jamPopup.contains(e.target)) {
            jamPopup.classList.add('hidden');
        }
    });

    // Initialize
    updateSelectedItems();
    updateRingkasan();
});
</script>

@endsection