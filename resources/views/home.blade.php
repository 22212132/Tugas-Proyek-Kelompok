<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laper.in</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <header class="bg-cyan-500 text-white p-4 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gray-500 rounded"></div>
            <span class="text-xl font-bold">Laper.in</span>
        </div>
        <div class="flex-1 mx-6">
            <input type="text"
                class="w-150 px-4 py-2 rounded-full bg-white text-black focus:outline-none">
            <img src="https://tse1.mm.bing.net/th/id/OIP.Wg7d9py54h7ViyCEq60PcgHaHa?cb=thfvnext&rs=1&pid=ImgDetMain&o=7&rm=3" alt="Search" 
                class="absolute left-42 top-9 -translate-y-1/2 w-8 h-8 opacity-70 pointer-events-none">

        </div>
        <div class="flex items-center gap-4">
            <button class="bg-cyan-800 hover:bg-gray-700 px-4 py-2 rounded-full">Pesan</button>
            <div class="w-8 h-8 rounded-full bg-gray-500"></div>
        </div>
    </header>

    <main class="p-6">

        <!-- Banner -->
        <section>
            <h2 class="text-xl font-bold">Laper? Pesan sini aja!</h2>
            <p class="text-gray-600 text-sm">Kantin Sekolah Kristen Immanuel</p>
            <div class="flex gap-4 mt-4 overflow-x-auto">
                @for ($i = 0; $i < 5; $i++)
                    <div class="w-28 h-28 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">🖼</span>
                    </div>
                @endfor
            </div>
        </section>

        <!-- Menu Kantin -->
        <section class="mt-8">
            <h2 class="text-xl font-bold mb-4">Populer</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-white rounded-2xl shadow p-4">
                        <div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400">🖼</span>
                        </div>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Kantin</p>
                            <h3 class="font-semibold">Food</h3>
                            <p class="text-gray-700">Rp00.000</p>
                        </div>
                        <div class="flex justify-between items-center mt-3">
                            <button class="w-full bg-gray-700 text-white py-2 rounded-full hover:bg-gray-800">
                                Pesan
                            </button>
                        </div>
                    </div>
                @endfor
            </div>
        </section>

    </main>
</body>
</html>
