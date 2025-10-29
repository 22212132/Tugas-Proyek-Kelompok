@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Daftar Kantin</h1>
    <a href="{{ route('canteens.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Kantin</a>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Nama</th>
                <th class="p-2">Deskripsi</th>
                <th class="p-2">Gambar</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($canteens as $canteen)
            <tr>
                <td class="p-2">{{ $canteen->name }}</td>
                <td class="p-2">{{ $canteen->description }}</td>
                <td class="p-2">
                    @if($canteen->image)
                        <img src="{{ asset('storage/'.$canteen->image) }}" width="70">
                    @endif
                </td>
                <td class="p-2">
                    <a href="{{ route('canteens.edit', $canteen->id) }}" class="text-blue-500">Edit</a> |
                    <form action="{{ route('canteens.destroy', $canteen->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
