<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register - Laper.in</title>
</head>
<body>
<div class="min-h-screen flex items-center justify-center bg-blue-600">
    <div class="w-full max-w-md m-8">
        
        <div class="bg-white rounded-xl shadow-xl p-8">
            <div class="text-center mb-8">
                <img src="{{ asset('logo/logo-color.png') }}" class="w-20 h-22 m-2 mx-auto">
                <h1 class="text-3xl font-bold m-1">Register</h1>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">

                <div class="flex items-center border border-gray-400 rounded-lg px-4 py-3 focus-within:border-indigo-500 transition duration-300 ease-in-out">
                    <i class="fas fa-user text-gray-500 mr-2"></i>
                    <input type="text" name="name" placeholder="Nama Lengkap" required
                        class="w-full focus:outline-none">
                </div>


                <div class="flex items-center border border-gray-400 rounded-lg px-4 py-3 focus-within:border-indigo-500 transition duration-300 ease-in-out">
                    <i class="fas fa-envelope text-gray-500 mr-2"></i>
                    <input type="email" name="email" placeholder="Email" required
                        class="w-full focus:outline-none">
                </div>

                <div class="flex items-center border border-gray-400 rounded-lg px-4 py-3 focus-within:border-indigo-500 transition duration-300 ease-in-out">
                    <i class="fas fa-school text-gray-500 mr-2"></i>
                    <select name="kelas" required class="w-full focus:outline-none bg-transparent">
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="1">X TKJ 1</option>
                        <option value="2">Kelas 2</option>
                        <option value="3">Kelas 3</option>
                    </select>
                </div>

                <div class="flex items-center border border-gray-400 rounded-lg px-4 py-3 focus-within:border-indigo-500 transition duration-300 ease-in-out relative">
                    <i class="fas fa-lock text-gray-500 mr-2"></i>
                    <input type="password" id="password" name="password" placeholder="Password" required class="w-full focus:outline-none pr-10">

                    <i class="fas fa-eye absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 cursor-pointer" id="togglePassword"></i>
                </div>

                <button type="submit" class="bg-indigo-600 w-full rounded-lg px-4 py-3 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2">
                    Register
                </button>


                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-semibold">
                            Sign In
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById("togglePassword").addEventListener("click", function () {
        const passwordInput = document.getElementById("password");
        const type = passwordInput.type === "password" ? "text" : "password";
        passwordInput.type = type;
        this.classList.toggle("fa-eye-slash");
    });
</script>


</body>
</html>