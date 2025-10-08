<h1>Daftar Produk</h1>

<a href="{{ route('products.create') }}">+ Tambah Produk</a>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif
<form action="{{ route('products.index') }}" method="GET">
    <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}">
    <button type="submit">Cari</button>
</form>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>Rp {{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>
            @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" width="50">
                @endif
            </td>
            <td>
                <a href="{{ route('products.edit', $product->id) }}">Edit</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="5">Belum ada produk</td>
        </tr>
    @endforelse
</table>