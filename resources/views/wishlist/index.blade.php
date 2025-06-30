<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya - FlashMart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col">
    <header class="w-full bg-white dark:bg-gray-800 shadow-sm py-4 px-6 md:px-12 flex items-center justify-between sticky top-0 z-50 rounded-b-lg">
        <a href="/home" class="flex items-center gap-2 text-2xl font-bold text-blue-600 dark:text-blue-400">
            <i class="bi bi-lightning-fill text-blue-500 mr-1"></i> FlashMart
        </a>
        <div class="flex items-center gap-4">
            <a href="/cart" class="relative text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-cart text-2xl"></i>
                @if(($cartCount ?? 0) > 0)
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                @endif
            </a>
            <a href="/wishlist" class="relative text-pink-600 hover:text-pink-700 transition-colors">
                <i class="bi bi-heart text-2xl"></i>
                @if(($wishlistCount ?? 0) > 0)
                    <span class="absolute -top-1 -right-1 bg-pink-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">{{ $wishlistCount }}</span>
                @endif
            </a>
            <a href="/profile" class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                <i class="bi bi-person-circle text-2xl"></i>
            </a>
            <form action="/logout" method="POST">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors shadow-md">Logout</button>
            </form>
        </div>
    </header>
    <main class="flex-1 w-full max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-3xl md:text-4xl font-bold mb-6 text-pink-600 dark:text-pink-400 text-center">Wishlist Saya</h1>
        @if(session('success'))
            <div class="mb-4 text-green-600 text-center">{{ session('success') }}</div>
        @endif
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($wishlistProducts as $product)
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
                    <form method="POST" action="{{ route('wishlist.remove') }}" class="w-full">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition shadow-md flex items-center justify-center"><i class="bi bi-heart-fill mr-2"></i>Hapus dari Wishlist</button>
                    </form>
                </div>
            @empty
                <div class="col-span-4 text-center text-gray-500">Belum ada produk di wishlist.</div>
            @endforelse
        </div>
    </main>
</body>
</html> 