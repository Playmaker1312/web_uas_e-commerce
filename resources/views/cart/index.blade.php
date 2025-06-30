<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja FlashMart</title>
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
        /* Table styling */
        .table-auto th, .table-auto td {
            @apply px-4 py-3 text-left border-b border-gray-200 dark:border-gray-700;
        }
        .table-auto thead th {
            @apply bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold uppercase text-sm;
        }
        .table-auto tbody tr:hover {
            @apply bg-gray-50 dark:bg-gray-700;
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
            <!-- Cart Icon (no badge needed as this is the cart page) -->
            <a href="/cart" class="relative text-blue-600 dark:text-blue-400 transition-colors">
                <i class="bi bi-cart-fill text-2xl"></i>
                @if(($cartCount ?? 0) > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
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
    <main class="flex-1 w-full max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-6 text-blue-700 dark:text-blue-300 text-center">Keranjang Belanja Anda</h1>

        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 text-red-600">{{ session('error') }}</div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            @php
                $total = 0;
                $cartProducts = [];
                foreach ($cart as $productId => $qty) {
                    $product = \App\Models\ZakiProduct::find($productId);
                    if ($product) {
                        $cartProducts[] = [
                            'product' => $product,
                            'qty' => $qty,
                            'subtotal' => $product->price * $qty
                        ];
                        $total += $product->price * $qty;
                    }
                }
            @endphp
            @if(count($cartProducts) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto mb-6">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Produk</th>
                            <th class="px-4 py-2">Harga</th>
                            <th class="px-4 py-2">Kuantitas</th>
                            <th class="px-4 py-2">Subtotal</th>
                            <th class="px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartProducts as $item)
                        <tr>
                            <td class="px-4 py-2 flex items-center gap-3">
                                @if($item['product']->image)
                                    <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="h-12 w-12 object-cover rounded-md shadow-sm">
                                @endif
                                <span class="font-medium text-gray-800 dark:text-gray-200">{{ $item['product']->name }}</span>
                            </td>
                            <td class="px-4 py-2 text-gray-700 dark:text-gray-300">Rp{{ number_format($item['product']->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                    <input type="number" name="quantity" value="{{ $item['qty'] }}" min="1" class="w-20 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-center text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition shadow-sm">Update</button>
                                </form>
                            </td>
                            <td class="px-4 py-2 font-semibold text-blue-600 dark:text-blue-400">Rp{{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 transition shadow-sm"><i class="bi bi-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">Total: <span class="text-blue-700 dark:text-blue-400">Rp{{ number_format($total, 0, ',', '.') }}</span></div>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition text-lg font-semibold shadow-lg">
                        <i class="bi bi-bag-check-fill mr-2"></i> Checkout
                    </button>
                </form>
            </div>
            @else
            <div class="text-center text-gray-500 mt-8 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <i class="bi bi-cart-x text-6xl text-gray-400 mb-4"></i>
                <p class="text-xl font-semibold">Keranjang Anda kosong.</p>
                <p class="text-gray-600 dark:text-gray-400 mt-2">Ayo, jelajahi produk kami dan mulai berbelanja!</p>
                <a href="/products" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow-md">Lihat Produk</a>
            </div>
            @endif
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
