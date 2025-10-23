@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')
<div class="flex justify-between gap-6 m-5 mt-8">

    <!-- Cart Table -->
    <div class="w-2/3">
        <h4 class="text-3xl font-bold mb-6">Cart</h4>

        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-4">Pilih</th>
                        <th class="p-4">Produk</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4 text-center">Jumlah</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- Sementara -->
                    <tr class="border-b hover:bg-gray-50"
                        data-id="1"
                        data-name="Nasi Kuning"
                        data-price="15000"
                        data-quantity="1">
                        <td class="p-4 text-center">
                            <input type="checkbox" class="w-4 h-4 text-blue-800 rounded select-item" checked>
                        </td>
                        <td class="p-4 flex items-center space-x-4">
                            <img src="img/NasiKuning.jpeg"
                                 class="w-16 h-16 object-cover rounded-lg bg-gray-200">
                            <div>
                                <span class="font-medium">Nasi Kuning</span>
                                <p class="text-sm text-gray-500">Dibuat dari bahan-bahan pilihan, dimasak fresh setiap hari, serta dikemas higienis sehingga aman dan praktis untuk dinikmati.</p>
                            </div>
                        </td>
                        <td class="p-4 font-semibold price-text">Rp15.000</td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center space-x-2">
                                <button class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300 decrease">-</button>
                                <span class="w-12 text-center font-medium quantity">1</span>
                                <button class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center hover:bg-gray-300 increase">+</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ringkasan Pesanan -->
    <div class="w-1/3">
        <div class="bg-white rounded-2xl shadow p-6 sticky top-6">
            <h3 class="text-2xl font-bold mb-6">Ringkasan Pesanan</h3>

            <div id="ringkasan" class="space-y-4 mb-6"></div>


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
                </div>

</div>

            <hr class="my-4">

            <div class="space-y-2 mb-4">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span id="subtotal" class="font-semibold">Rp0</span>
                </div>
                <div class="flex justify-between">
                    <span>Ongkir</span>
                    <span id="ongkir">Rp0</span>
                </div>
            </div>

            <hr class="my-4">

            <div class="flex justify-between text-lg font-bold mb-6">
                <span>Total</span>
                <span id="total">Rp0</span>
            </div>

            <button class="bg-blue-500 text-white w-full py-3 rounded-lg font-semibold hover:bg-indigo-600 transition duration-200 mb-4">
                Lanjutkan Pembayaran
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function formatRupiah(number) {
        return 'Rp' + number.toLocaleString('id-ID');
    }

    function updateRingkasan() {
        const rows = document.querySelectorAll('tbody tr');
        const ringkasan = document.getElementById('ringkasan');
        const subtotalEl = document.getElementById('subtotal');
        const totalEl = document.getElementById('total');
        const ongkirEl = document.getElementById('ongkir');

        const metode = document.querySelector('input[name="metode"]:checked').value;
        let ongkir = metode === 'delivery' ? 2000 : 0;

        let total = 0;
        ringkasan.innerHTML = '';

        rows.forEach(row => {
            const checkbox = row.querySelector('.select-item');
            if (checkbox.checked) {
                const name = row.dataset.name;
                const price = parseInt(row.dataset.price);
                const quantity = parseInt(row.querySelector('.quantity').textContent);
                const subtotal = price * quantity;

                total += subtotal;

                const div = document.createElement('div');
                div.classList.add('flex', 'justify-between', 'items-center');
                div.innerHTML = `
                    <div>
                        <span class="font-medium">${quantity}x ${name}</span>
                    </div>
                    <span class="font-semibold">${formatRupiah(subtotal)}</span>
                `;
                ringkasan.appendChild(div);

                // update harga di kolom tabel
                row.querySelector('.price-text').textContent = formatRupiah(subtotal);
            }
        });

        subtotalEl.textContent = formatRupiah(total);
        ongkirEl.textContent = formatRupiah(ongkir);
        totalEl.textContent = formatRupiah(total + ongkir);
    }

    // Event listeners
    updateRingkasan();
    document.querySelectorAll('.select-item').forEach(cb => cb.addEventListener('change', updateRingkasan));
    document.querySelectorAll('.metode').forEach(r => r.addEventListener('change', updateRingkasan));

    document.querySelectorAll('.increase').forEach(btn => btn.addEventListener('click', e => {
        const tr = e.target.closest('tr');
        const span = tr.querySelector('.quantity');
        let qty = parseInt(span.textContent);
        qty++;
        span.textContent = qty;
        tr.dataset.quantity = qty;
        updateRingkasan();
    }));

    document.querySelectorAll('.decrease').forEach(btn => btn.addEventListener('click', e => {
        const tr = e.target.closest('tr');
        const span = tr.querySelector('.quantity');
        let qty = parseInt(span.textContent);
        if (qty > 1) {
            qty--;
            span.textContent = qty;
            tr.dataset.quantity = qty;
            updateRingkasan();
        }
    }));
});

document.addEventListener('DOMContentLoaded', function() {

    const jamInput = document.getElementById('jam');
    const popup = document.getElementById('jam-popup');

    
    function generateJamOptions() {
        const startHour = 7;
        const endHour = 15;
        const interval = 5; 

        for (let hour = startHour; hour <= endHour; hour++) {
            for (let minute = 0; minute < 60; minute += interval) {
                const hh = hour.toString().padStart(2, '0');
                const mm = minute.toString().padStart(2, '0');
                const time = `${hh}:${mm}`;

                const option = document.createElement('div');
                option.textContent = time;
                option.className = "px-4 py-2 hover:bg-blue-100 cursor-pointer";
                option.addEventListener('click', () => {
                    jamInput.value = time;
                    popup.classList.add('hidden');
                });
                popup.appendChild(option);
            }
        }
    }

    generateJamOptions();

    // Tampilkan popup saat input diklik
    jamInput.addEventListener('click', () => {
        popup.classList.toggle('hidden');
    });

    // Tutup popup jika klik di luar area
    document.addEventListener('click', (e) => {
        if (!popup.contains(e.target) && e.target !== jamInput) {
            popup.classList.add('hidden');
        }
    });
});

</script>

@endsection
