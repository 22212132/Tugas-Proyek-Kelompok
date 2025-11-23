@extends('layouts.sidebar')

@section('content')
@if (session('success'))
    <div class="bg-green-100 text-green-700 border border-green-300 p-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-10">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-semibold text-gray-800">Riwayat Pembelian</h2>

        <form method="GET">
            <select name="filter" onchange="this.form.submit()" 
                    class="border border-gray-300 rounded-md px-3 py-2 text-sm">
                <option value="month" {{ $filter=='month'?'selected':'' }}>Bulan ini</option>
                <option value="week" {{ $filter=='week'?'selected':'' }}>Minggu ini</option>
                <option value="today" {{ $filter=='today'?'selected':'' }}>Hari ini</option>
            </select>
        </form>
    </div>

    @forelse($transactions as $transaction)
        <div class="py-4 border-b flex justify-between items-center">
            <div>
                <p class="font-medium text-gray-800">
                    @if($transaction->product)
                        {{ $transaction->product->name }}
                    @else
                        Produk Tidak Tersedia
                    @endif
                </p>
                <p class="text-sm text-gray-500">
                    @if(isset($transaction->quantity))
                        x{{ $transaction->quantity }}
                    @else
                        Jumlah tidak tersedia
                    @endif
                </p>
                <!-- Informasi tambahan tentang transaksi -->
                <p class="text-xs text-gray-400 mt-1">
                    {{ $transaction->created_at->format('d M Y H:i') }}
                    @if(isset($transaction->order) && $transaction->order->delivery_place)
                        • {{ $transaction->order->delivery_place }}
                    @endif
                </p>
            </div>

            <div class="text-right">
                <p class="text-gray-900 font-bold">
                    -Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                </p>
                <!-- Tampilkan status jika ada -->
                @if(isset($transaction->order) && $transaction->order->status)
                    <span class="inline-block px-2 py-1 text-xs rounded 
                        @if($transaction->order->status == 'delivered') bg-green-100 text-green-800
                        @elseif($transaction->order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($transaction->order->status == 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($transaction->order->status) }}
                    </span>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center py-6">Belum ada transaksi.</p>
    @endforelse


</div>
@endsection