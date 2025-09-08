<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .card-shadow { box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
        .checkbox-round { border-radius: 50%; }
        input:focus { outline: none; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <!-- Main Content -->
    <div class="w-full max-w-md">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Welcome Back</h1>
            <p class="text-gray-600 mt-2">Sign in to access your account</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-xl card-shadow p-8">
            <!-- Login Form -->
            <form class="space-y-5">
                <!-- Username Field -->
                <div class="flex items-center border border-gray-300 rounded-lg px-4 py-3 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition-all duration-200">
                    <i class="fas fa-user text-gray-400 mr-3"></i>
                    <input type="text" placeholder="Username" class="w-full bg-transparent border-none focus:ring-0">
                </div>

                <!-- Password  -->
                <div class="flex items-center border border-gray-300 rounded-lg px-4 py-3 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition-all duration-200">
                    <i class="fas fa-lock text-gray-400 mr-3"></i>
                    <input type="password" placeholder="Password" class="w-full bg-transparent border-none focus:ring-0">
                </div>

                <!--  Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-3 rounded-lg font-medium hover:from-blue-700 hover:to-indigo-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    Login
                </button>
            </form>

            <!-- Sign Up -->
            <div class="mt-6 text-center">
                <p class="text-gray-600">Don't Have an Account? <a href="#" class="text-blue-600 font-medium hover:text-blue-800 transition-colors duration-200">Sign Up</a></p>
            </div>
        </div>

    </div>

   
</body>
</html>