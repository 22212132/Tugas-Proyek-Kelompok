<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laper.in</title>
    <style>
        body{
            font-family: "DM Sans", sans-serif;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>
<header class="bg-blue-600 text-white px-16 py-3 flex items-center justify-between shadow-md">

    <div class="flex items-center space-x-3">
        <img src="logo/logo-mono.png" alt="Logo" class="w-10 h-12">
        <span class="font-bold text-lg">Laper.in</span>
    </div>


    <div class="flex-1 flex justify-center">
        <div class="relative w-4/5">
            <span class="absolute inset-y-0 left-3 flex items-center text-blue-500 ">
                <i class="fa fa-search"></i>
            </span>
            <input type="text" placeholder="Mau makan apa hari ini?"
                   class="w-full pl-10 pr-4 py-2 rounded-full focus:outline-none text-gray-800 placeholder-gray-400 placeholder:italic">
        </div>
    </div>

    <div class="flex items-center space-x-8">

        <a href="{{ route('cart')}}" class="relative hover:text-indigo-200">
            <i class="fa-solid fa-cart-shopping text-xl"></i>
        </a>

        <a class="hover:text-indigo-200">
            <i class="fa-solid fa-heart text-xl"></i>
        </a>

        <div class="h-6 w-px bg-white/50"></div>

        <a href="{{ route('profile') }}" class="block transition-transform hover:scale-105 focus:outline-none">
            <img src="https://ui-avatars.com/api/?name=User+Default&background=random"
                alt="Akun"
                class="w-9 h-9 rounded-full border-2 border-white object-cover hover:border-blue-200 transition-colors cursor-pointer">
        </a>
    </div>
</header>

    @yield('content')
</body>
</html>
