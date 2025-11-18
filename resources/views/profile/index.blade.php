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
        
        <div class="flex space-x-4 mb-8">
            <button onclick="toggleModal('profileModal')"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full transition duration-300 shadow-md">
                Change Profile
            </button>
            <button onclick="toggleModal('passwordModal')"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-full transition duration-300 shadow-md">
                Change Password
            </button>
        </div>
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

<div id="profileModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden z-50 transition-opacity duration-300 items-center justify-center" onclick="toggleModal('profileModal')">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-8 transform transition-all duration-300 scale-95 opacity-0" onclick="event.stopPropagation()">
        <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Change Profile</h3>
        
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-2">Foto Profil</label>
                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @error('profile_photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            @if ($user->profile_photo_path)
                <div class="mb-6">
                    <p class="text-sm font-medium text-gray-700 mb-2">Opsi Foto:</p>
                    <button type="button" onclick="document.getElementById('removePhotoForm').submit();"
                            class="text-red-600 hover:text-red-800 text-sm font-semibold transition duration-150">
                        Remove Photo Profile
                    </button>
                </div>
            @endif

            <div class="mb-5">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="class" class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                <input type="text" id="class" name="class" value="{{ old('class', $user->class) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                @error('class')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('profileModal')"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-150">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150">
                    Simpan Perubahan
                </button>
            </div>
        </form>

        <form id="removePhotoForm" action="{{ route('profile.remove_photo') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>


<div id="passwordModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 hidden z-50 transition-opacity duration-300 items-center justify-center" onclick="toggleModal('passwordModal')">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-8 transform transition-all duration-300 scale-95 opacity-0" onclick="event.stopPropagation()">
        <h3 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-2">Change Password</h3>
        
        <form id="passwordForm" action="{{ route('profile.update_password') }}" method="POST" onsubmit="return validatePassword(event)">
            @csrf
            @method('PUT')

            <div class="mb-5">
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                <input type="password" id="current_password" name="current_password" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                @error('current_password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru (Min. 8 karakter)</label>
                <input type="password" id="password" name="password" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                <p id="passwordError" class="text-red-500 text-xs mt-1 hidden">Password baru minimal harus 8 karakter.</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                <p id="confirmationError" class="text-red-500 text-xs mt-1 hidden">Konfirmasi password tidak cocok.</p>
                @error('password_confirmation')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="toggleModal('passwordModal')"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-150">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150">
                    Ganti Password
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');

            setTimeout(() => {
                modal.querySelector('div').classList.remove('scale-95', 'opacity-0');
                modal.querySelector('div').classList.add('scale-100', 'opacity-100');
            }, 10);
        } else {

            modal.querySelector('div').classList.remove('scale-100', 'opacity-100');
            modal.querySelector('div').classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300); 
        }
    }


    function validatePassword(event) {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        const passwordError = document.getElementById('passwordError');
        const confirmationError = document.getElementById('confirmationError');
        let isValid = true;


        passwordError.classList.add('hidden');
        confirmationError.classList.add('hidden');

        if (password.length < 8) {
            passwordError.classList.remove('hidden');
            isValid = false;
        }

        // Konfirmasi Password
        if (password !== confirmation) {
            confirmationError.classList.remove('hidden');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
        return isValid;
    }


    document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->has('current_password') || $errors->has('password') || $errors->has('password_confirmation'))
            toggleModal('passwordModal');
        @elseif ($errors->has('name') || $errors->has('email') || $errors->has('profile_photo'))
            toggleModal('profileModal');
        @endif
    });
</script>
@endsection