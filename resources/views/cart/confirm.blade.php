<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Checkout FlashMart</title>
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

        <!-- Search Bar (Responsive) -->
        <div class="flex-grow max-w-md mx-4 hidden md:block">
            <div class="relative">
                <input type="text" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>

        <!-- User Actions (Cart, Profile, Logout) -->
        <div class="flex items-center gap-4">
            <!-- Cart Icon -->
            <a href="/cart" class="relative text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-cart text-2xl"></i>
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                    {{ isset($cartCount) ? $cartCount : '0' }}
                </span>
            </a>
            <!-- Profile Icon -->
            <a href="/profile" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-person-circle text-2xl"></i>
            </a>
            <!-- Logout Button -->
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors shadow-md">Logout</button>
            </form>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 w-full max-w-3xl mx-auto px-4 py-8">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <h2 class="text-2xl md:text-3xl font-bold mb-6 text-blue-700 dark:text-blue-300 text-center">Konfirmasi Checkout</h2>

            <form action="{{ route('cart.confirm') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="shipping_address" class="block font-semibold mb-2 text-gray-700 dark:text-gray-300">Alamat Pengiriman</label>
                    <input type="text" id="shipping_address" name="shipping_address" value="{{ old('shipping_address', $shipping_address) }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    @error('shipping_address')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <h3 class="font-semibold text-lg mb-3 text-gray-700 dark:text-gray-300">Produk yang Dibeli</h3>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                        @forelse($cartProducts as $item)
                        <div class="flex items-center p-4 {{ $loop->even ? 'bg-gray-50 dark:bg-gray-700' : 'bg-white dark:bg-gray-800' }}">
                            <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-20 h-20 object-cover rounded-md mr-4 shadow-sm">
                            <div class="flex-1">
                                <div class="font-medium text-lg text-gray-900 dark:text-gray-100">{{ $item['product']->name }}</div>
                                <div class="text-sm text-gray-600 dark:text-gray-400">Kuantitas: {{ $item['qty'] }}</div>
                            </div>
                            <div class="font-semibold text-lg text-blue-600 dark:text-blue-400">Rp{{ number_format($item['subtotal'],0,',','.') }}</div>
                        </div>
                        @empty
                        <div class="p-4 text-center text-gray-500">Keranjang kosong.</div>
                        @endforelse
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
                    <span class="font-bold text-xl text-gray-800 dark:text-gray-100">Total</span>
                    <span class="font-bold text-xl text-blue-700 dark:text-blue-400">Rp{{ number_format($total,0,',','.') }}</span>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold text-lg shadow-md transition-colors">
                    <i class="bi bi-check-circle-fill mr-2"></i> Konfirmasi & Proses Order
                </button>
            </form>
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
