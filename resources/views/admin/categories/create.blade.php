<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori | Admin FlashMart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
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
            <a href="/admin/products" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-box-seam text-xl"></i> <span class="hidden md:inline">Produk</span>
            </a>
            <a href="/admin/categories" class="block py-2 px-4 rounded-lg bg-blue-700 dark:bg-blue-800 transition-colors flex items-center gap-3">
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
    <main class="flex-1 flex items-center justify-center p-4 md:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg w-full max-w-lg border border-gray-200 dark:border-gray-700">
            <h1 class="text-3xl md:text-4xl font-bold mb-6 text-blue-700 dark:text-blue-300 flex items-center gap-3"><i class="bi bi-tags"></i> Tambah Kategori</h1>
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded flex items-center gap-2"><i class="bi bi-exclamation-circle"></i> <span>{{ $errors->first() }}</span></div>
                @endif
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded flex items-center gap-2"><i class="bi bi-check-circle"></i> <span>{{ session('success') }}</span></div>
                @endif
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Nama Kategori</label>
                    <input type="text" name="name" autofocus class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('name') border-red-500 ring-2 ring-red-300 @enderror" required value="{{ old('name') }}">
                    @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
                <div class="flex justify-between gap-2">
                    <a href="{{ route('categories.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 flex items-center gap-1"><i class="bi bi-arrow-left"></i> Kembali</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-1"><i class="bi bi-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html> 