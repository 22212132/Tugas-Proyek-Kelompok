<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>

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
<body class="bg-white-800 flex min-h-screen">

    <div class="w-1/6 bg-blue-800 text-white flex flex-col py-8 px-8 space-y-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3">
            <img src="{{ asset('logo/logo-mono.png') }}" alt="Logo" class="w-10 h-12">
            <span class="font-bold text-lg">Laper.in</span>
        </a>

        <a href="#" 
           class="flex items-center w-full space-x-2  'bg-white/10' : 'hover:bg-white/10' }} rounded-md px-3 py-2 transition">
            <i class="fa-solid fa-chart-simple text-white"></i>
            <span>Dashoard</span>
        </a>

        <a  href="{{ route('canteens.index') }}"
           class="flex items-center w-full space-x-2 'bg-white/10' : 'hover:bg-white/10' }} rounded-md px-3 py-2 transition">
            <i class="fa fa-store text-white"></i>
            <span>Canteen</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="flex items-center w-full space-x-2 'bg-white/10' : 'hover:bg-white/10' }} rounded-md px-3 py-2 transition">
            <i class="fa fa-box text-white"></i>
            <span>Products</span>
        </a>

        <a  href="#"
           class="flex items-center w-full space-x-2  'bg-white/10' : 'hover:bg-white/10' }} rounded-md px-3 py-2 transition">
            <i class="fa fa-clock-rotate-left text-white"></i>
            <span>Orders</span>
        </a>

        <a  href="#"
           class="flex items-center w-full space-x-2 'bg-white/10' : 'hover:bg-white/10' }} rounded-md px-3 py-2 transition">
            <i class="fa fa-user text-white"></i>
            <span>Account</span>
        </a>
    </div>

    <!-- Content -->
    <main class="flex-1 flex justify-center items-center p-10">
        @yield('content')
    </main>

</body>
</html>
