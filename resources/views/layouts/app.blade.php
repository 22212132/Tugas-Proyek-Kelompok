@php
    $currentRoute = Route::currentRouteName();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Laper.in</title>

    <style>
        body {
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

        /* Popup styling */
        .profile-popup {
            display: none;
            position: absolute;
            top: 55px;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 220px;
            padding: 12px 16px;
            z-index: 50;
            transition: all 0.15s ease-in-out;
        }

        .profile-container.show .profile-popup {
            display: block;
        }
    </style>
</head>
<body>
<header class="bg-blue-700 text-white px-16 py-3 flex items-center justify-between shadow-md">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="flex items-center space-x-3">
        <img src="{{ asset('logo/logo-mono.png') }}" alt="Logo" class="w-10 h-12">
        <span class="font-bold text-lg">Laper.in</span>
    </a>

    <!-- Search -->
    <div class="flex-1 flex justify-center">
    <div class="relative w-4/5">
        <span class="absolute inset-y-0 left-3 flex items-center text-blue-500">
            <i class="fa fa-search"></i>
        </span>

        <input 
            type="text" 
            id="globalSearch" 
            placeholder="Mau makan apa hari ini?" 
            value="{{ request('search') }}" 
            class="w-full pl-10 pr-4 py-2 rounded-full focus:outline-none text-gray-800 placeholder-gray-400 placeholder:italic"
        >

        <script>
            document.getElementById('globalSearch').addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();

                    const search = this.value.trim();
                    const currentPath = window.location.pathname;

                    let baseUrl = '/home';
                    if (currentPath.includes('products')) baseUrl = '/products';
                    else if (currentPath.includes('canteens')) baseUrl = '/canteens';

                    window.location.href = `${baseUrl}?search=${encodeURIComponent(search)}`;
                }
            });
        </script>
        </div>
    </div>


    <div class="flex items-center space-x-8">
        <a href="{{ route('order.cart') }}" class="relative hover:text-indigo-200">
            <i class="fa-solid fa-cart-shopping text-xl"></i>
        </a>

        <a href="{{ route('favorite') }}" class="hover:text-indigo-200">
            <i class="fa-solid fa-heart text-xl"></i>
        </a>

        <div class="h-6 w-px bg-white/50"></div>

        <div class="relative profile-container" id="profileContainer">
            @php
                $user = Auth::user();
                $initial = $user ? strtoupper(substr($user->name, 0, 1)) : 'U';
            @endphp

            <a href="{{ route('profile')}}" id="profileAvatar"
                 class="flex items-center justify-center w-9 h-9 rounded-full bg-white text-blue-600 font-bold border-2 border-white cursor-pointer hover:border-blue-200 transition-colors select-none">
                {{ $initial }}
            </a>


            <div class="profile-popup text-gray-700">
                @if($user)
            <div class="border-b pb-3 mb-3">
                <p class="font-semibold text-lg">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">{{ $user->kelas->name ?? 'Tidak ada kelas' }}</p>

    
                @if(isset($user->saldo))
                    <div class="mt-2 flex items-center justify-between bg-blue-50 text-blue-700 px-3 py-2 rounded-lg text-sm font-semibold">
                        <span><i class="fa-solid fa-wallet mr-2"></i>Saldo</span>
                        <span>Rp {{ number_format($user->saldo, 0, ',', '.') }}</span>
                    </div>
                @else
                    <div class="mt-2 bg-gray-100 text-gray-600 px-3 py-1.5 rounded-lg text-sm italic text-center">
                        Saldo belum tersedia
                    </div>
                @endif
</div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition">
                            <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                        </button>
                    </form>
                @else
                    <div class="text-sm text-gray-500">
                        Belum login<br>
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login Sekarang</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>

@yield('content')

<script>
    const profileContainer = document.getElementById('profileContainer');
    const avatar = document.getElementById('profileAvatar');
    const popup = profileContainer.querySelector('.profile-popup');

    let hoverTimeout;

    // Saat mouse masuk ke avatar atau popup → tampilkan
    const showPopup = () => {
        clearTimeout(hoverTimeout);
        profileContainer.classList.add('show');
    };

    // Saat mouse keluar dari avatar dan popup → sembunyikan setelah delay
    const hidePopup = () => {
        hoverTimeout = setTimeout(() => {
            if (!profileContainer.matches(':hover')) {
                profileContainer.classList.remove('show');
            }
        }, 150); // sedikit delay biar gak "kedip"
    };

    avatar.addEventListener('mouseenter', showPopup);
    popup.addEventListener('mouseenter', showPopup);

    avatar.addEventListener('mouseleave', hidePopup);
    popup.addEventListener('mouseleave', hidePopup);
</script>


</body>
</html>
