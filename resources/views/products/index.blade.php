<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk FlashMart</title>
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
            <form method="GET" action="/products" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </form>
        </div>

        <!-- User Actions (Cart, Wishlist, Profile, Logout) -->
        <div class="flex items-center gap-4">
            <!-- Cart Icon with Badge -->
            <a href="/cart" class="relative text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-cart text-2xl"></i>
                @if(($cartCount ?? 0) > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                @endif
            </a>
            <!-- Wishlist Icon with Badge -->
            <a href="/wishlist" class="relative text-pink-600 hover:text-pink-700 transition-colors">
                <i class="bi bi-heart text-2xl"></i>
                @php $wishlist = session('wishlist', []); $wishlistCount = count($wishlist); @endphp
                @if($wishlistCount > 0)
                    <span class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $wishlistCount }}</span>
                @endif
            </a>
            <!-- Profile Icon -->
            <a href="/profile" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-person-circle text-2xl"></i>
            </a>
            <!-- Logout Button -->
            <form action="/logout" method="POST">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors shadow-md">Logout</button>
            </form>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 w-full max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-6 text-blue-700 dark:text-blue-300 text-center">Daftar Produk FlashMart</h1>

        @if(session('success'))
            <div class="mb-4 text-green-600 text-center">{{ session('success') }}</div>
        @endif
        @if(request('search'))
            <div class="mb-4 text-gray-600 text-center">Hasil pencarian untuk: <span class="font-semibold">"{{ request('search') }}"</span></div>
        @endif
        <form method="GET" action="/products" class="mb-6 flex flex-col md:flex-row items-center gap-4 justify-center">
            <input type="hidden" name="search" value="{{ request('search') }}">
            <label for="category_id" class="text-gray-700 dark:text-gray-200">Filter Kategori:</label>
            <select name="category_id" id="category_id" class="px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if(($selectedCategory ?? '') == $category->id) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
            <label for="harga_min" class="text-gray-700 dark:text-gray-200">Harga Min:</label>
            <input type="number" name="harga_min" id="harga_min" value="{{ $harga_min ?? '' }}" class="w-28 px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" placeholder="0">
            <label for="harga_max" class="text-gray-700 dark:text-gray-200">Harga Max:</label>
            <input type="number" name="harga_max" id="harga_max" value="{{ $harga_max ?? '' }}" class="w-28 px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" placeholder="99999999">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-md">Filter</button>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4 flex flex-col items-center text-center transform transition-transform hover:scale-105 hover:shadow-lg">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-40 w-full object-cover rounded-lg mb-4">
                    @else
                        <div class="h-40 w-full bg-gray-200 rounded-lg mb-4 flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                    <h2 class="text-lg font-semibold mb-2 text-blue-700 dark:text-blue-200">{{ $product->name }}</h2>
                    <div class="text-gray-600 dark:text-gray-400 mb-1">Kategori: <span class="font-medium">{{ $product->category ? $product->category->name : '-' }}</span></div>
                    <div class="text-blue-600 dark:text-blue-400 font-bold text-xl mb-4">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                    <form method="POST" action="{{ route('cart.add') }}" class="w-full mb-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition shadow-md">Tambah ke Keranjang</button>
                    </form>
                    @php $wishlist = session('wishlist', []); @endphp
                    @if(isset($wishlist[$product->id]))
                        <form method="POST" action="{{ route('wishlist.remove') }}" class="w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition shadow-md flex items-center justify-center"><i class="bi bi-heart-fill mr-2"></i>Hapus dari Wishlist</button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('wishlist.add') }}" class="w-full">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="w-full bg-pink-100 text-pink-600 py-2 rounded-lg hover:bg-pink-200 transition shadow-md flex items-center justify-center"><i class="bi bi-heart mr-2"></i>Wishlist</button>
                        </form>
                    @endif
                </div>
            @endforeach
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
                    <a href="#" class="text-400 hover:text-white transition-colors"><i class="bi bi-twitter text-xl"></i></a>
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
