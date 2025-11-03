@extends('layouts.sidebar')

@section('title', 'Profile')

@section('content')
@php
    $user = Auth::user();
    $initial = strtoupper(substr($user->name, 0, 1));
@endphp

<div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-10">

    <div class="flex flex-col items-center">
        <div class="w-32 h-32 bg-blue-600 text-white text-5xl font-bold flex items-center justify-center rounded-full mb-4 select-none">
            {{ $initial }}
        </div>
        <h2 class="text-2xl font-semibold mb-4">{{ $user->name }}</h2>
        <div class="flex space-x-4 mb-8">
            <button class="bg-blue-700 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Change Profile</button>
            <button class="bg-blue-700 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Change Password</button>
        </div>
    </div>

    <div class="space-y-6">
        <div>
            <label class="block font-semibold mb-1">Nama</label>
            <input type="text" value="{{ $user->name }}" 
                   class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 cursor-not-allowed"
                   readonly>
        </div>

        <div>
            <label class="block font-semibold mb-1">Email</label>
            <input type="email" value="{{ $user->email }}" 
                   class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 cursor-not-allowed"
                   readonly>
        </div>

        <div>
            <label class="block font-semibold mb-1">Kelas</label>
            <input type="text" value="{{ $user->kelas->name ?? 'Tidak ada kelas' }}" 
                   class="w-full border border-gray-300 rounded-md px-3 py-2 bg-gray-100 cursor-not-allowed">
        </div>
    </div>

    <div class="flex justify-between items-center mt-8">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin logout?')"
                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">
                Logout
            </button>
        </form>
    </div>
</div>
@endsection
