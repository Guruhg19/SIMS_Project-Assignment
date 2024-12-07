<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>SIMS Web App</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
          rel="stylesheet"
        />
        <link href="../../css/style.css" rel="stylesheet" />
        <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
        />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
      </head>

  <body class="font-[Poppins] h-screen">
    <div class="flex h-screen">
      <!-- Sidebar -->
      <div
  class="lg:w-64 w-full bg-gradient-to-r from-red-600 to-red-600 text-white flex flex-col p-4"
>
<div class="flex justify-center items-center mb-8 mt-8 space-x-4">
    <img src="{{ asset('uploads/Handbag.png') }}" alt="Icon SIMS" class="w-5 h-5">
    <h1 class="text-xl font-semibold">SIMS Web App</h1>
</div>

  <nav class="flex flex-col space-y-4">
    <a href="{{ route('products.index') }}" class="hover:bg-red-400 py-2 px-4 rounded-lg transition duration-300 flex items-center">
      <i class="fas fa-box mr-2"></i> Produk
    </a>
    <a href="{{ route('profile') }}" class="hover:bg-red-400 py-2 px-4 rounded-lg transition duration-300 flex items-center">
      <i class="fas fa-user mr-2"></i> Profil
    </a>
    <a href="{{ route('logout') }}" class="hover:bg-red-400 py-2 px-4 rounded-lg transition duration-300 flex items-center">
      <i class="fas fa-sign-out-alt mr-2"></i> Logout
    </a>
  </nav>
</div>


      <!-- Konten Utama -->
      <div class="flex-1 bg-white p-8 overflow-auto">@yield('content')</div>
    </div>

    @yield('scripts')
    <script>
      function Openbar() {
        document.querySelector(".sidebar").classList.toggle("left-[-300px]");
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/heroicons@1.0.6/umd/heroicons.js"></script>
  </body>
</html>
