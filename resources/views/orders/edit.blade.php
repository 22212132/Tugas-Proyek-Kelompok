@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pesanan</h2>

    <!-- tampilkan pesan error jika ada -->
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="customer_name">Nama Customer</label><br>
            <input type="text" name="customer_name" id="customer_name" value="{{ $order->customer_name }}" required>
        </div>

        <div>
            <label for="product_id">Produk</label><br>
            <select name="product_id" id="product_id" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $order->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="quantity">Jumlah</label><br>
            <input type="number" name="quantity" id="quantity" value="{{ $order->quantity }}" required>
        </div>

        <div>
            <label for="total_price">Total Harga</label><br>
            <input type="number" step="0.01" name="total_price" id="total_price" value="{{ $order->total_price }}" required>
        </div>

        <br>
        <button type="submit">Update Pesanan</button>
    </form>
</div>
@endsection