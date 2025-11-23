@extends('layouts.admin')

@section('content')
<div class="p-6">

    <h1 class="text-3xl font-bold mb-6">Informasi User</h1>

    <div class="bg-white shadow rounded-lg overflow-hidden w-full">
        <table class="min-w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3">Saldo</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 text-sm">

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4">{{ $user->id }}</td>
                    <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                    <td class="px-6 py-4">Rp{{ number_format($user->saldo, 0, ',', '.') }}</td>

                    <td class="px-6 py-4 flex gap-2">
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
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

</div>
@endsection
