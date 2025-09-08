<h1>Daftar Pesanan</h1>
@foreach($orders as $order)
    <div>
        <p>Nama: {{ $order->customer_name }}</p>
        <p>Total: Rp{{ $order->total_price }}</p>
        <a href="{{ route('orders.show', $order) }}">Detail</a>
    </div>
@endforeach