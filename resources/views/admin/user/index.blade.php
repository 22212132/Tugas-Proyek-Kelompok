@extends('layouts.admin')

@section('content')
<div class="min-h-screen w-full">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 border border-green-300 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Pengguna</h1>
        </div>

    <div class="bg-white shadow rounded-lg overflow-hidden w-full">
        <table class="min-w-full text-center border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Nama</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Saldo</th>
                    <th class="px-4 py-2 text-sm font-semibold text-gray-700">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $user->id }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $user->name }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">Rp{{ number_format($user->saldo, 0, ',', '.') }}</td>

                    <td class="px-4 py-2 text-sm text-gray-700 flex gap-2">
                        <div class="flex justify-center space-x-2">
                            <a href="{{ route('user.edit') }}"
                                class="bg-yellow-500 text-white px-4 py-1 rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('user.delete') }}" method="POST"
                                onsubmit="return confirm('Yakin ingin hapus akun?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>
@endsection
