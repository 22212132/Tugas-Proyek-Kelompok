<h1>Buat Pesanan</h1>
<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <input type="text" name="customer_name" placeholder="Nama Customer">
    <input type="email" name="customer_email" placeholder="Email Customer">

    <h3>Pilih Produk:</h3>
    @foreach($products as $product)
        <div>
            <input type="checkbox" name="products[]" value="{{ $product->id }}">
            {{ $product->name }} - Rp{{ $product->price }}
            <input type="number" name="quantities[]" value="1" min="1">
        </div>
    @endforeach

    <button type="submit">Simpan Pesanan</button>
</form>