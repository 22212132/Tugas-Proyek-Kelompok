@extends('layouts.sidebar')

@section('content')
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
                <p class="font-medium text-gray-800">{{ $transaction->product->name }}</p>
                <p class="text-sm text-gray-500">x{{ $transaction->quantity }}</p>
            </div>

            <p class="text-gray-900 font-bold">
                Rp{{ number_format($transaction->total_price, 0, ',', '.') }}
            </p>
        </div>
    @empty
        <p class="text-gray-500 text-center py-6">Belum ada transaksi.</p>
    @endforelse

</div>
@endsection
