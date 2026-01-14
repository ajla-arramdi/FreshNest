<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - FreshNest</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0fdf4; /* hijau very light */
        }
    </style>
</head>
<body class="bg-green-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Dashboard Pengguna</h1>
            <p class="text-gray-600 mb-6">Selamat datang di akun Anda, {{ auth()->user()->name }}!</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-green-50 p-4 rounded-lg border border-green-100">
                    <h3 class="font-semibold text-green-800">Pesanan Saya</h3>
                    <p class="text-2xl font-bold text-green-600 mt-2">5</p>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <h3 class="font-semibold text-blue-800">Produk Favorit</h3>
                    <p class="text-2xl font-bold text-blue-600 mt-2">12</p>
                </div>

                <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-100">
                    <h3 class="font-semibold text-yellow-800">Kupon Tersedia</h3>
                    <p class="text-2xl font-bold text-yellow-600 mt-2">3</p>
                </div>
            </div>

            <div class="mt-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-block bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>