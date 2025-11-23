@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 shadow rounded">

    <h1 class="text-2xl font-bold mb-4">Edit Data User</h1>

    <form action="{{ route('user.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Saldo</label>
            <input type="number" name="saldo" value="{{ $user->saldo }}"
                class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('user.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Batal
            </a>

            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection
