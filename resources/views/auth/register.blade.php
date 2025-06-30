<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi FlashMart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom button styles for consistency */
        .btn {
            @apply px-4 py-2 rounded-lg font-medium transition-all duration-300;
        }
        .btn-primary {
            @apply bg-blue-600 text-white hover:bg-blue-700 shadow-md;
        }
        .btn-secondary {
            @apply bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 shadow-sm;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
    <!-- Header Section -->
    <header class="w-full bg-white dark:bg-gray-800 shadow-sm py-4 px-6 md:px-12 flex items-center justify-between sticky top-0 z-50 rounded-b-lg">
        <!-- Logo -->
        <a href="/home" class="flex items-center gap-2 text-2xl font-bold text-blue-600 dark:text-blue-400">
            <i class="bi bi-lightning-fill text-blue-500 mr-1"></i> FlashMart
        </a>

        <!-- Search Bar (Responsive) - Hidden on register page as it's not the primary function -->
        <div class="flex-grow max-w-md mx-4 hidden">
            <div class="relative">
                <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- User Actions (Cart, Profile) - Logout button is not present on register page -->
        <div class="flex items-center gap-4">
            <!-- Cart Icon -->
            <a href="/cart" class="relative text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-cart text-2xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">3</span>
            </a>
            <!-- Profile Icon -->
            <a href="/profile" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-person-circle text-2xl"></i>
            </a>
        </div>
    </header>

    <!-- Main Content Area - Register Form -->
    <main class="flex-1 w-full flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-xl p-8">
            <h2 class="text-3xl font-bold mb-8 text-center text-blue-700 dark:text-blue-300">Daftar Akun Baru</h2>

            <!-- Notifikasi error/sukses -->
            @if(session('success'))
                <div class="mb-4 text-green-600 text-sm p-3 bg-green-50 rounded-lg border border-green-200">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 text-red-600 text-sm p-3 bg-red-50 rounded-lg border border-red-200">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-4 text-red-600 text-sm p-3 bg-red-50 rounded-lg border border-red-200">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/register" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" required autofocus>
                </div>
                <div>
                    <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="password" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" required>
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400" onclick="togglePassword('password', 'togglePasswordIcon')">
                            <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </span>
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 text-sm font-semibold mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10" required>
                        <span class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-gray-400" onclick="togglePassword('password_confirmation', 'togglePasswordIcon2')">
                            <i class="bi bi-eye" id="togglePasswordIcon2"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg shadow-md">
                    <i class="bi bi-person-plus-fill mr-2"></i> Daftar
                </button>
            </form>
            <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">Sudah punya akun? <a href="/login" class="text-blue-600 hover:underline font-medium">Masuk di sini</a></p>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-800 dark:bg-gray-950 text-gray-300 dark:text-gray-400 py-8 px-6 md:px-12 rounded-t-lg mt-12">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About FlashMart -->
            <div>
                <h3 class="text-lg font-semibold text-white dark:text-gray-100 mb-4">FlashMart</h3>
                <p class="text-sm">
                    Toko online terpercaya Anda untuk semua kebutuhan. Kami menawarkan produk berkualitas dengan harga terbaik.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-white dark:text-gray-100 mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/products" class="hover:text-blue-400 transition-colors">Semua Produk</a></li>
                    <li><a href="/categories" class="hover:text-blue-400 transition-colors">Kategori</a></li>
                    <li><a href="/about" class="hover:text-blue-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="/privacy" class="hover:text-blue-400 transition-colors">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <!-- Contact Us -->
            <div>
                <h3 class="text-lg font-semibold text-white dark:text-gray-100 mb-4">Hubungi Kami</h3>
                <p class="text-sm">
                    Email: <a href="mailto:support@flashmart.com" class="hover:text-blue-400">support@flashmart.com</a><br>
                    Telepon: +62 812-3456-7890<br>
                    Alamat: Jl. Contoh No. 123, Kota Fiktif, Indonesia
                </p>
                <div class="flex gap-4 mt-4">
                    <!-- Social Media Icons -->
                    <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="bi bi-facebook text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="bi bi-twitter text-xl"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="bi bi-instagram text-xl"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center text-xs text-gray-500 dark:text-gray-600 mt-8">
            &copy; 2024 FlashMart. Hak Cipta Dilindungi.
        </div>
    </footer>

    <script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
    </script>
</body>
</html>
