<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk | Admin FlashMart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .main-table th, .main-table td { @apply px-4 py-3 text-left border-b border-gray-200 dark:border-gray-700; }
        .main-table thead th { @apply bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold uppercase text-sm; }
        .main-table tbody tr:hover { @apply bg-gray-50 dark:bg-gray-700; }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-20 md:w-64 bg-blue-800 dark:bg-blue-950 text-white flex flex-col min-h-screen shadow-lg">
        <div class="p-6 text-2xl md:text-3xl font-bold border-b border-blue-700 dark:border-blue-800 flex items-center justify-center gap-2">
            <i class="bi bi-lightning-fill text-blue-300"></i> <span class="hidden md:inline">Admin Panel</span>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="/dashboard" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-speedometer2 text-xl"></i> <span class="hidden md:inline">Dashboard</span>
            </a>
            <a href="/admin/products" class="block py-2 px-4 rounded-lg bg-blue-700 dark:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-box-seam text-xl"></i> <span class="hidden md:inline">Produk</span>
            </a>
            <a href="/admin/categories" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-tags text-xl"></i> <span class="hidden md:inline">Kategori</span>
            </a>
            <a href="/admin/orders" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-receipt text-xl"></i> <span class="hidden md:inline">Order</span>
            </a>
        </nav>
        <form method="POST" action="/logout" class="p-4 border-t border-blue-700 dark:border-blue-800">
            @csrf
            <button type="submit" class="w-full bg-red-600 py-2 rounded-lg hover:bg-red-700 transition-colors shadow-md flex items-center justify-center gap-2">
                <i class="bi bi-box-arrow-right"></i> <span class="hidden md:inline">Logout</span>
            </button>
        </form>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 p-4 md:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="w-full max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-3xl md:text-4xl font-bold text-blue-700 dark:text-blue-300 flex items-center gap-3">
                    <i class="bi bi-box-seam"></i> Daftar Produk
                </h1>
                <a href="{{ route('products.create') }}" class="btn btn-primary flex items-center gap-2"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
            </div>
            <!-- Filter & Search -->
            <form method="GET" class="mb-4 flex flex-col md:flex-row gap-2 items-center">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="w-full md:w-64 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" />
                <select name="category" class="w-full md:w-48 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @if(request('category') == $cat->id) selected @endif>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-1"><i class="bi bi-search"></i> Cari</button>
            </form>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full main-table rounded-lg overflow-hidden">
                        <thead class="bg-blue-100 dark:bg-blue-900">
                            <tr>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="py-2">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded shadow" />
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>Rp{{ number_format($product->price,0,',','.') }}</td>
                                    <td>
                                        @if($product->stock == 0)
                                            <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs font-semibold">Habis</span>
                                        @elseif($product->stock <= 5)
                                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-semibold">Stok Menipis ({{ $product->stock }})</span>
                                        @else
                                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">{{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td class="flex space-x-2">
                                        <a href="{{ route('products.edit', $product) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 flex items-center gap-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus produk?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 flex items-center gap-1"><i class="bi bi-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-gray-400">
                                        <i class="bi bi-inbox text-3xl mb-2"></i><br>Belum ada produk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html> 