<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Nama:</label>
    <input type="text" name="name" required><br>

    <label>Harga:</label>
    <input type="number" name="price" required><br>

    <label>Stok:</label>
    <input type="number" name="stock" required><br>

    <label>Gambar:</label>
    <input type="file" name="image"><br>

    <button type="submit">Simpan</button>
</form>