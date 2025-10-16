@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Kantin</h1>

    <form action="{{ route('canteens.update', $canteen->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block font-semibold mb-1">Nama Kantin</label>
            <input type="text" name="name" id="name" class="w-full border rounded p-2" required value="{{ old('name', $canteen->name) }}">
        </div>

        <div>
            <label for="description" class="block font-semibold mb-1">Deskripsi</label>
            <textarea name="description" id="description" class="w-full border rounded p-2" rows="3">{{ old('description', $canteen->description) }}</textarea>
        </div>

        <div>
            <label for="image" class="block font-semibold mb-1">Gambar Kantin</label>
            @if($canteen->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$canteen->image) }}" alt="Kantin" class="w-32 rounded">
                </div>
            @endif
            <input type="file" name="image" id="image" class="w-full border rounded p-2">
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('canteens.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Batal</a>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Perbarui</button>
        </div>
    </form>
</div>
@endsection
