@extends('layouts.sidebar')

@section('title', 'Profile')

@section('content')
@php
    $user = Auth::user();
    $initial = strtoupper(substr($user->name, 0, 1));
    // Asumsi: $user->getKelasNameAttribute() atau $user->kelas->name ada
    $className = $user->kelas->name ?? 'Tidak ada kelas'; 
    $profilePhotoUrl = $user->profile_photo_path 
                       ? asset('storage/' . $user->profile_photo_path) 
                       : null;
@endphp

<div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl p-10 mx-auto">

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    @if (session('success_password'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success_password') }}</span>
        </div>
    @endif

    <div class="flex flex-col items-center">
        <div class="w-32 h-32 mb-4 select-none relative">
            @if ($profilePhotoUrl)
                <img src="{{ $profilePhotoUrl }}" alt="Profile Photo" 
                     class="w-full h-full object-cover rounded-full border-4 border-blue-600 shadow-lg">
            @else
                <div class="w-full h-full bg-blue-600 text-white text-5xl font-extrabold flex items-center justify-center rounded-full shadow-lg">
                    {{ $initial }}
                </div>
            @endif
        </div>
        
        <h2 class="text-3xl font-bold mb-2 text-gray-800">{{ $user->name }}</h2>
        <p class="text-gray-500 mb-6">{{ $user->email }}</p>

    </div>

    <div class="space-y-6 pt-6 border-t border-gray-200">
        <div>
            <label class="block font-semibold mb-1 text-gray-700">Nama</label>
            <input type="text" value="{{ $user->name }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-700 cursor-not-allowed focus:outline-none"
                   readonly>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Email</label>
            <input type="email" value="{{ $user->email }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-700 cursor-not-allowed focus:outline-none"
                   readonly>
        </div>

        <div>
            <label class="block font-semibold mb-1 text-gray-700">Kelas</label>
            <input type="text" value="{{ $className }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 text-gray-700 cursor-not-allowed focus:outline-none"
                   readonly>
        </div>
    </div>

    <div class="flex justify-start items-center mt-8">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition duration-300 shadow-lg">
                Logout
            </button>
        </form>
    </div>
</div>


@endsection