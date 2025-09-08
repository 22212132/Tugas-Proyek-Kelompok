<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label>Nama:</label>
    <input type="text" name="name" value="{{ $product->name }}" required><br>

    <label>Deskripsi:</label>
    <textarea name="description">{{ $product->description }}</textarea><br>

    <label>Harga:</label>
    <input type="text" name="price" value="{{ $product->price }}" required><br>

    <label>Stok:</label>
    <input type="text" name="stock" value="{{ $product->stock }}" required><br>

    <label>Gambar:</label>
    <input type="file" name="image"><br>
    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" width="100">
    @endif
    <br>

    <button type="submit">Update</button>
</form>