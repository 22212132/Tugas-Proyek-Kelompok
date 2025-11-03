@extends('layouts.sidebar')

@section('title', 'Saldo')

@section('content')
@php
    $user = Auth::user();
    $saldo = $user->saldo ?? 0; 
@endphp

<div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-10">

    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Saldo</h2>
        <p class="text-sm italic text-gray-500 mt-1">*Saldo diisi dengan admin kantin</p>
    </div>

    <div class="bg-blue-700 text-white rounded-lg p-6 text-center">
        <p class="text-lg">Saldo Tersedia</p>
        <h1 class="text-4xl font-bold mt-2">Rp{{ number_format($saldo, 0, ',', '.') }}</h1>
    </div>


</div>
@endsection