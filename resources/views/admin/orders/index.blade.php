@extends('layouts.admin')

@section('content')
<div class="min-h-screen w-full">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Daftar Pesanan</h1>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden w-full">
        <table class="min-w-full text-center border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">User</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Total Harga</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Detail</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->id }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->user->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        <span class="px-2 py-1 rounded text-sm bg-blue-100 text-blue-800">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="p-3">
                        <button 
                            onclick="document.getElementById('detail-{{ $order->id }}').classList.toggle('hidden')"
                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Lihat
                        </button>
                    </td>
                </tr>

                <tr class="hidden bg-gray-50" id="detail-{{ $order->id }}">
                    <td colspan="6" class="p-4">
                        <p class="font-semibold mb-2">Produk:</p>

                        <table class="w-full text-sm mb-3">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-2">Nama</th>
                                    <th class="p-2">Qty</th>
                                    <th class="p-2">Harga</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($order->items as $item)
                                <tr class="border-b">
                                    <td class="p-2">{{ $item->product->name }}</td>
                                    <td class="p-2">{{ $item->quantity }}</td>
                                    <td class="p-2">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <p class="font-medium">Total: 
                            <span class="text-green-600">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                        </p>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection