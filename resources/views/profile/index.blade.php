<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>User Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-800 flex">

  <!-- Sidebar -->
  <div class="w-1/6 bg-blue-800 text-white flex flex-col items-start py-8 px-6 space-y-4">
    
    <a href="{{ route ('home')}}" class="inline-flex items-center text-white mb-6 hover:text-indigo-200 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        <span class="font-bold">Kembali</span>
    </a>

    <button class="flex items-center w-full space-x-2 bg-white/10 rounded-md px-3 py-2">
      <i class="fa fa-user text-white"></i>
      <span>Account</span>
    </button>

    <button class="flex items-center w-full space-x-2 hover:bg-white/10 rounded-md px-3 py-2">
      <i class="fa fa-wallet text-white"></i>
      <span>Saldo</span>
    </button>

    <button class="flex items-center w-full space-x-2 hover:bg-white/10 rounded-md px-3 py-2">
      <i class="fa fa-clock-rotate-left text-white"></i>
      <span>History</span>
    </button>
  </div>

  <!-- Main Content -->
  <div class="flex-1 flex justify-center items-center p-10">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-10">

      <!-- Profile Section -->
      <div class="flex flex-col items-center">
        <div class="w-32 h-32 bg-gray-300 rounded-full mb-4"></div>
        <h2 class="text-2xl font-semibold mb-4">(NAMA)’s Profile Picture</h2>
        <div class="flex space-x-4 mb-8">
          <button class="bg-blue-700 hover:bg-indigo-700 text-white px-4 py-2 rounded">Change Profile</button>
          <button class="bg-blue-700 hover:bg-indigo-700 text-white px-4 py-2 rounded">Remove Profile</button>
        </div>
      </div>


      <div class="space-y-6">
        <div>
          <label class="block font-semibold mb-1">Name</label>
          <input type="text" value="User123" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
          <label class="block font-semibold mb-1">Email Address</label>
          <input type="email" value="User123@gmail.com" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
        </div>

        <div>
          <label class="block font-semibold mb-1">Class</label>
          <input type="text" value="Class 1" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
        </div>
      </div>

      <!-- Buttons -->
      <div class="flex justify-between items-center mt-8">
        <button class="bg-blue-700 hover:bg-indigo-700 text-white px-4 py-2 rounded">Change Password</button>
        <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">Logout</button>
      </div>
    </div>
  </div>

</body>
</html>
