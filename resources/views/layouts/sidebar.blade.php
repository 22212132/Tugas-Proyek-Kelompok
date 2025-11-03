<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Profil Pengguna')</title>

    <link href="/src/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: "DM Sans", sans-serif;
        }
    </style>
</head>
<body class="bg-blue-800 flex min-h-screen">

    <div class="w-1/6 bg-blue-800 text-white flex flex-col items-start py-8 px-6 space-y-4">
        <a href="{{ route('home') }}" class="inline-flex items-center text-white mb-6 hover:text-indigo-200 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            <span class="font-bold">Kembali</span>
        </a>

        <a href="{{ route('profile') }}" 
           class="flex items-center w-full space-x-2 {{ request()->routeIs('profile') ? 'bg-white/10' : 'hover:bg-white/10' }} rounded-md px-3 py-2 transition">
            <i class="fa fa-user text-white"></i>
            <span>Account</span>
        </a>

        <a href="{{ route('saldo') }}"
           class="flex items-center w-full space-x-2 {{ request()->routeIs('profile.saldo') ? 'bg-white/10' : 'hover:bg-white/10' }} rounded-md px-3 py-2 transition">
            <i class="fa fa-wallet text-white"></i>
            <span>Saldo</span>
        </a>

        <a  
           class="flex items-center w-full space-x-2 {{ request()->routeIs('profile.history') ? 'bg-white/10' : 'hover:bg-white/10' }} rounded-md px-3 py-2 transition">
            <i class="fa fa-clock-rotate-left text-white"></i>
            <span>History</span>
        </a>
    </div>

    <!-- Content -->
    <main class="flex-1 flex justify-center items-center p-10">
        @yield('content')
    </main>

</body>
</html>
