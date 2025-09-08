@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-blue-600">
    <div class="w-full max-w-md">
        
        <div class="bg-white rounded-xl shadow-xl p-8">
            <div class="text-center mb-8">
            <img src="logo/logo-color.png" class="w-24 h-26 m-2 mx-auto">
            <h1 class="text-3xl font-bold ">Laper.in</h1>
            <p class="text-s text-gray-500 mt-2">
                Sistem Pemesanan Makanan Kantin <br>
                Sekolah Kristen Immanuel
            </p>
        </div>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">

                <div class="flex items-center border border-gray-300 rounded-lg px-4 py-3 focus-within:border-black-500 focus-within:border-black transition duration-300 ease-in-out" >
                    <i class="fas fa-user text-black mr-2"></i>
                    <input type="text" name="email" placeholder="Email" required
                        class="w-full focus:outline-none">
                </div>

                <div class="flex items-center border border-gray-300 rounded-lg px-4 py-3 focus-within:border-black-500 focus-within:border-black transition duration-300 ease-in-out" >
                    <i class="fas fa-lock text-black mr-2"></i>
                    <input type="password" name="password" placeholder="Password" required
                           class="w-full focus:outline-none">
                </div>

                <!-- Remember -->
                <label class="flex items-center">
                    <input type="checkbox" name="remember" 
                        class="rounded text-blue-600 w-4 h-4">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>

                <!-- Button -->
                <button type="submit" name="login" class="bg-indigo-600 w-full rounded-lg px-4 py-3 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 ">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
