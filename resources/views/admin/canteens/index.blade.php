@extends('layouts.admin')

@section('content')
<div class="min-h-screen w-full">

    @if (session('success'))
        <div class="bg-green-100 text-green-700 border border-green-300 p-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-800">Daftar Kantin</h1>
            <a href="{{ route('canteens.create') }}"
               class="bg-blue-700 hover:bg-indigo-700 text-white text-sm px-3 py-1.5 rounded shadow">
                Tambah Kantin
            </a>
        </div>

    <table class="w-full mt-4 border">
        <thead>
            <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Deskripsi</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($canteens as $canteen)
            <tr>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $canteen->id }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $canteen->name }}</td>
                <td class="px-4 py-2 text-sm text-gray-700">{{ $canteen->description }}</td>
                <td class="px-4 py-2 text-sm text-gray-700 text-center">
                    <div class="flex justify-center space-x-2">
                        <a href="{{ route('canteens.edit', $canteen->id) }}"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                            Edit
                        </a>

                        <form action="{{ route('canteens.destroy', $canteen->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                Hapus
                            </button>
                    </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
