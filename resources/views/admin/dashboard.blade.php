@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <div class="grid grid-cols-3 gap-6 mb-8">

        <div class="p-5 bg-white rounded-xl shadow">
            <p class="font-semibold">Total Products</p>
            <h2 class="text-3xl font-bold">{{ $totalProducts }}</h2>
        </div>

        <div class="p-5 bg-white rounded-xl shadow">
            <p class="font-semibold">Orders</p>
            <h2 class="text-3xl font-bold">{{ $totalOrders }}</h2>
        </div>

        <div class="p-5 bg-white rounded-xl shadow">
            <p class="font-semibold">Pendapatan</p>
            <h2 class="text-3xl font-bold">Rp {{ number_format($totalIncome,0,',','.') }}</h2>
        </div>

    </div>

    <!-- Grafik -->
    <div class="bg-white p-6 rounded-xl shadow mb-8">
        <h2 class="text-lg font-bold mb-4">Grafik Order Bulanan</h2>

        <canvas id="ordersChart"></canvas>
    </div>

    <div class="grid grid-cols-2 gap-6">

        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-bold mb-4">Recent Activity</h2>

            @foreach ($recentOrders as $order)
                <div class="border-b py-2">
                    <p><strong>Order #{{ $order->id }}</strong></p>
                    <p class="text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</p>
                </div>
            @endforeach
        </div>

        <!-- Top Products -->
        <div class="bg-white p-6 rounded-xl shadow">
            <h2 class="text-lg font-bold mb-4">Top Products</h2>

            <table class="w-full">
                <tr>
                    <th class="text-left py-2">Produk</th>
                    <th class="text-left py-2">Stok</th>
                    <th class="text-left py-2">Harga</th>
                    <th class="text-left py-2">Pendapatan</th>
                </tr>

                @foreach ($topProducts as $product)
                <tr class="border-t">
                    <td class="py-2">{{ $product->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>Rp{{ number_format($product->price,0,',','.') }}</td>
                    <td>Rp{{ number_format($product->orders_count * $product->price,0,',','.') }}</td>
                </tr>
                @endforeach
            </table>
        </div>

    </div>

</div>

<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('ordersChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agu","Sep","Okt","Nov","Des"],
            datasets: [{
                label: 'Orders',
                data: @json(array_values($monthlyOrders->toArray())),
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderRadius: 6
            }]
        }
    });
</script>

@endsection
