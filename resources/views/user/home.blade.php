<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlashMart - Beranda Pengguna</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Keeping custom rounded-element and btn styles for potential future use,
           though the new layout uses direct Tailwind classes for these elements. */
        .rounded-element {
            border-radius: 0.5rem; /* Equivalent to rounded-lg */
        }
        .btn {
            @apply px-5 py-1.5 rounded-sm font-medium transition-all duration-300;
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

        <!-- Search Bar (Responsive) -->
        <div class="flex-grow max-w-md mx-4 hidden md:block">
            <div class="relative">
                <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- User Actions (Profile, Logout) -->
        <div class="flex items-center gap-4">
            <!-- Profile Icon -->
            <a href="/profile" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-person-circle text-2xl"></i>
            </a>
            <!-- Logout Button -->
            <form action="/logout" method="POST">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors shadow-md">Logout</button>
            </form>
            <!-- Cart Icon with Badge -->
            <a href="/cart" class="relative text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-cart text-2xl"></i>
                @if(($cartCount ?? 0) > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 w-full max-w-4xl mx-auto px-4 py-8 flex flex-col items-center justify-center">
        <h1 class="text-3xl md:text-4xl font-bold mb-4 text-blue-700 dark:text-blue-300 text-center">Selamat Datang di FlashMart!</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-10 text-center max-w-2xl">
            Temukan berbagai produk berkualitas tinggi dan nikmati pengalaman belanja online yang mudah dan menyenangkan.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full">
            <!-- Card: Lihat Produk -->
            <a href="/products" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center text-center hover:shadow-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition group transform hover:-translate-y-1">
                <i class="bi bi-shop text-blue-600 mb-4 group-hover:scale-110 transition duration-300 text-6xl"></i>
                <span class="text-xl font-semibold text-blue-700 dark:text-blue-300 mb-2">Lihat Produk</span>
                <span class="text-gray-600 dark:text-gray-400 text-sm">Jelajahi semua produk terbaik yang tersedia di FlashMart.</span>
            </a>
            <!-- Card: Keranjang -->
            <a href="/cart" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center text-center hover:shadow-lg hover:bg-green-50 dark:hover:bg-gray-700 transition group transform hover:-translate-y-1">
                <i class="bi bi-cart text-green-600 mb-4 group-hover:scale-110 transition duration-300 text-6xl"></i>
                <span class="text-xl font-semibold text-green-700 dark:text-green-300 mb-2">Keranjang</span>
                <span class="text-gray-600 dark:text-gray-400 text-sm">Lihat dan kelola produk yang ingin Anda beli sebelum checkout.</span>
            </a>
            <!-- Card: Riwayat Order -->
            <a href="/orders/history" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center text-center hover:shadow-lg hover:bg-yellow-50 dark:hover:bg-gray-700 transition group transform hover:-translate-y-1">
                <i class="bi bi-clock-history text-yellow-500 mb-4 group-hover:scale-110 transition duration-300 text-6xl"></i>
                <span class="text-xl font-semibold text-yellow-600 dark:text-yellow-300 mb-2">Riwayat Order</span>
                <span class="text-gray-600 dark:text-gray-400 text-sm">Lihat kembali semua pesanan yang pernah Anda lakukan di FlashMart.</span>
            </a>
            <!-- Card: Pengaturan Akun -->
            <a href="/account/settings" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center text-center hover:shadow-lg hover:bg-purple-50 dark:hover:bg-gray-700 transition group transform hover:-translate-y-1">
                <i class="bi bi-gear text-purple-600 mb-4 group-hover:scale-110 transition duration-300 text-6xl"></i>
                <span class="text-xl font-semibold text-purple-700 dark:text-purple-300 mb-2">Pengaturan Akun</span>
                <span class="text-gray-600 dark:text-gray-400 text-sm">Kelola informasi profil, alamat, dan preferensi akun Anda.</span>
            </a>
             <!-- Card: Bantuan & Dukungan -->
            <a href="/help" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center text-center hover:shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition group transform hover:-translate-y-1">
                <i class="bi bi-question-circle text-gray-600 mb-4 group-hover:scale-110 transition duration-300 text-6xl"></i>
                <span class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">Bantuan & Dukungan</span>
                <span class="text-gray-600 dark:text-gray-400 text-sm">Dapatkan bantuan dan temukan jawaban untuk pertanyaan Anda.</span>
            </a>
            <!-- Card: Favorit -->
            <a href="/wishlist" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 flex flex-col items-center justify-center text-center hover:shadow-lg hover:bg-red-50 dark:hover:bg-gray-700 transition group transform hover:-translate-y-1">
                <i class="bi bi-heart text-red-600 mb-4 group-hover:scale-110 transition duration-300 text-6xl"></i>
                <span class="text-xl font-semibold text-red-700 dark:text-red-300 mb-2">Favorit</span>
                <span class="text-gray-600 dark:text-gray-400 text-sm">Simpan produk favorit Anda untuk dibeli nanti.</span>
            </a>
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
</body>
</html>
