<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMS Web App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex">
    <!-- Side Kiri (Logo dan Form Login) -->
    <div class="w-1/2 flex flex-col justify-center items-center bg-gray-50 p-10">
        <div class="flex items-center justify-center mb-6">
            <!-- Ikon tas belanja berwarna merah menggunakan Heroicons -->
            <svg xmlns="http://www.w3.org/2000/svg" class=" pt-3 h-10 w-10 text-red-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2L4 6H2v12h20V6h-2l-2-4m-4 4h-6V5a1 1 0 011-1h4a1 1 0 011 1v5z"/>
            </svg>
            <h1 class="text-3xl font-bold text-gray-800">SIMS Web App</h1>
        </div>
        
        
        <p class="text-gray-800 mb-8 text-2xl font-bold">Masuk atau buat akun untuk memulai</p>
        <!-- Form Login -->
        <form action="{{ route('login.post') }}" method="POST" class="w-full max-w-sm space-y-5">
            @csrf
            <!-- Input Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Masukkan Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}">
            </div>
            <!-- Input Password -->
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-2">Masukkan Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <!-- Tombol Login -->
            <button type="submit"
                class="w-full bg-red-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none">
                Masuk
            </button>
        </form>
    </div>

    <div class="w-1/2 h-full bg-cover bg-center" style="background-image: url('{{ asset('uploads/frame.png') }}');">
    </div>

</body>
</html>
