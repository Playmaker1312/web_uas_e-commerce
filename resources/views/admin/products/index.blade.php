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
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #232946 0%, #1a223f 100%);
            min-height: 100vh;
        }
        .sidebar-glass {
            background: rgba(30,41,59,0.95);
            backdrop-filter: blur(8px);
            border-radius: 2rem;
            min-width: 70px;
            max-width: 220px;
            box-shadow: 0 4px 32px 0 rgba(30,41,59,0.18);
            border: 1.5px solid #334155;
            transition: all 0.2s;
        }
        .sidebar-glass .brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            padding: 2rem 1.5rem 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            letter-spacing: 0.04em;
        }
        .sidebar-glass nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }
        .sidebar-glass nav a {
            color: #cbd5e1;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.9rem 1.5rem;
            border-radius: 1.2rem;
            font-size: 1.15rem;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
        }
        .sidebar-glass nav a.active, .sidebar-glass nav a:hover {
            background: rgba(59,130,246,0.18);
            color: #fff;
        }
        .sidebar-glass .logout {
            margin-top: auto;
            padding: 1.5rem;
        }
        .sidebar-glass .logout button {
            width: 100%;
            background: #ef4444;
            color: #fff;
            border-radius: 1rem;
            padding: 0.7rem 0;
            font-weight: 600;
            border: none;
            transition: background 0.15s;
        }
        .sidebar-glass .logout button:hover {
            background: #dc2626;
        }
        .glass {
            background: rgba(255,255,255,0.18);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
            backdrop-filter: blur(16px) saturate(180%);
            -webkit-backdrop-filter: blur(16px) saturate(180%);
            border-radius: 1.5rem;
            border: 1.5px solid rgba(255,255,255,0.24);
        }
        .dark .glass {
            background: rgba(30,41,59,0.45);
            box-shadow: 0 8px 32px 0 rgba(30,41,59,0.28);
            border: 1.5px solid rgba(51,65,85,0.32);
        }
        .sidebar-glass {
            @apply glass p-4 md:p-6 flex flex-col min-h-screen w-20 md:w-64 fixed left-0 top-0 z-30 transition-all duration-300;
        }
        .main-content-glass {
            @apply glass p-4 md:p-8 mt-4 md:ml-24 md:ml-72 min-h-screen transition-all duration-300;
        }
        .table-glass {
            @apply glass w-full overflow-hidden rounded-2xl mt-2;
        }
        .table-glass th, .table-glass td {
            @apply bg-transparent border-none text-gray-800 dark:text-gray-100;
        }
        .table-glass th {
            @apply font-semibold uppercase text-xs py-3 px-4;
        }
        .table-glass td {
            @apply py-3 px-4 text-sm align-middle;
        }
        .table-glass tr:nth-child(even) td {
            background: rgba(59,130,246,0.07);
        }
        .dark .table-glass tr:nth-child(even) td {
            background: rgba(30,41,59,0.22);
        }
        .btn-glass {
            @apply px-4 py-2 rounded-xl font-medium bg-blue-500/80 text-white hover:bg-blue-600/90 transition-colors text-sm flex items-center gap-2 shadow-none border-none backdrop-blur-md;
        }
        .btn-glass.secondary {
            @apply bg-gray-200/80 text-gray-800 hover:bg-gray-300/90 dark:bg-gray-700/80 dark:text-gray-200 dark:hover:bg-gray-600/90;
        }
        .badge-glass {
            @apply inline-flex items-center gap-1 px-2 py-1 rounded-xl text-xs font-semibold bg-gray-100/80 text-gray-700 dark:bg-gray-800/80 dark:text-gray-200 shadow-sm;
        }
        .badge-glass.habis { @apply bg-red-100/80 text-red-800; }
        .badge-glass.menipis { @apply bg-yellow-100/80 text-yellow-700; }
        .badge-glass.aman { @apply bg-green-100/80 text-green-700; }
        .empty-state-glass {
            @apply flex flex-col items-center justify-center py-10 text-gray-400;
        }
        @media (max-width: 768px) {
            .sidebar-glass { position: static; width: 100%; min-height: auto; border-radius: 1.5rem 1.5rem 0 0; }
            .main-content-glass { margin-left: 0; margin-top: 0.5rem; }
        }
        .search-glass-card {
            background: rgba(51,65,85,0.55);
            border-radius: 1.2rem;
            padding: 1.1rem 1.5rem;
            margin-bottom: 2.2rem;
            box-shadow: 0 2px 12px 0 rgba(59,130,246,0.08);
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 1.2rem;
            justify-content: space-between;
        }
        .searchbar-glass-2 {
            flex: 1 1 260px;
            background: rgba(30,41,59,0.85);
            border-radius: 1.2rem;
            padding: 0.9rem 1.2rem 0.9rem 2.7rem;
            color: #fff;
            font-size: 1.08rem;
            border: none;
            outline: none;
            box-shadow: none;
            position: relative;
            min-width: 0;
        }
        .searchbar-glass-2::placeholder {
            color: #cbd5e1;
            opacity: 0.8;
        }
        .searchbar-icon {
            position: absolute;
            left: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #60a5fa;
            font-size: 1.2rem;
            pointer-events: none;
        }
        .add-btn-glass {
            @apply btn-glass;
            white-space: nowrap;
            font-size: 1rem;
            padding: 0.9rem 1.7rem;
            border-radius: 1.2rem;
            box-shadow: 0 2px 8px 0 rgba(59,130,246,0.10);
            background: #22c55e;
            color: #fff;
            transition: background 0.15s;
        }
        .add-btn-glass:hover {
            background: #16a34a;
        }
        @media (max-width: 600px) {
            .search-glass-card {
                flex-direction: column;
                align-items: stretch;
                gap: 0.7rem;
                padding: 1rem 0.7rem;
            }
            .add-btn-glass {
                width: 100%;
            }
        }
        .table-glass {
            width: 100%;
            border-radius: 1.2rem;
            overflow: hidden;
            background: rgba(36, 44, 72, 0.85);
            box-shadow: 0 4px 32px 0 rgba(30,41,59,0.13);
            border: none;
            margin-top: 0;
            position: relative;
            text-align: center;
        }
        .table-glass thead th {
            position: sticky;
            top: 0;
            z-index: 2;
            background: rgba(59,130,246,0.13);
            color: #cbd5e1;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 1rem;
            padding: 1.1rem 1rem;
            border-bottom: 1px solid rgba(59,130,246,0.13);
            letter-spacing: 0.04em;
            backdrop-filter: blur(4px);
            text-align: center;
        }
        .table-glass tbody tr {
            transition: background 0.18s;
        }
        .table-glass tbody tr:hover {
            background: rgba(59,130,246,0.10);
        }
        .table-glass td {
            padding: 1.05rem 1rem;
            border: none;
            color: #e0e7ef;
            background: transparent;
            font-size: 1rem;
            vertical-align: middle;
            text-align: center;
        }
        .table-glass tbody tr:nth-child(even) td {
            background: rgba(59,130,246,0.06);
        }
        .table-glass tbody tr:last-child td {
            border-bottom: none;
        }
        @media (max-width: 768px) {
            .table-glass thead th, .table-glass td {
                padding: 0.7rem 0.5rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100/60 via-white/80 to-blue-200/60 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 text-gray-900 dark:text-gray-100 min-h-screen flex">
    <!-- Sidebar -->
    <aside class="sidebar-glass flex flex-col items-center py-4 px-2 h-full min-h-screen">
        <div class="brand">
            <i class="bi bi-cart-fill text-blue-300"></i>
            <span class="hidden md:inline">FlashMart</span>
        </div>
        <nav class="flex-1 w-full mt-4">
            <a href="/dashboard"><i class="bi bi-house-door-fill"></i> <span class="hidden md:inline">Dashboard</span></a>
            <a href="/admin/products" class="active"><i class="bi bi-box-seam"></i> <span class="hidden md:inline">Produk</span></a>
            <a href="/admin/categories"><i class="bi bi-tags"></i> <span class="hidden md:inline">Kategori</span></a>
            <a href="/admin/orders"><i class="bi bi-receipt"></i> <span class="hidden md:inline">Order</span></a>
        </nav>
        <div class="logout w-full">
            <form action="/logout" method="POST">
                <button type="submit"><i class="bi bi-box-arrow-right"></i> <span class="hidden md:inline">Logout</span></button>
            </form>
        </div>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 main-content-glass">
        <div class="w-full max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-3xl md:text-4xl font-bold flex items-center gap-3">
                    <i class="bi bi-box-seam"></i> Daftar Produk
                </h1>
            </div>
            <form method="GET" class="search-glass-card relative mb-8">
                <span class="searchbar-icon"><i class="bi bi-search"></i></span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..." class="searchbar-glass-2" />
                <select name="category" class="searchbar-glass-2" style="max-width:220px">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @if(request('category') == $cat->id) selected @endif>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-glass flex items-center gap-2"><i class="bi bi-search"></i> Cari</button>
                <a href="{{ route('products.create') }}" class="add-btn-glass flex items-center gap-2"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
            </form>
            <div class="table-glass p-6">
                <div class="overflow-x-auto w-full">
                    <table class="table-glass">
                        <thead>
                            <tr>
                                <th style="width:10%">Gambar</th>
                                <th style="width:25%">Nama Produk</th>
                                <th style="width:18%">Kategori</th>
                                <th style="width:15%">Harga</th>
                                <th style="width:12%">Stok</th>
                                <th style="width:20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="transition-all duration-300 hover:bg-blue-100/40 dark:hover:bg-blue-900/40">
                                    <td class="align-middle text-center">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img" style="max-width:48px;max-height:48px;border-radius:0.7rem;object-fit:cover;box-shadow:0 2px 8px 0 rgba(59,130,246,0.10);margin:auto;" />
                                        @else
                                            <span class="text-gray-400 flex items-center justify-center"><svg xmlns='http://www.w3.org/2000/svg' class='h-8 w-8 mx-auto' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z' /></svg></span>
                                        @endif
                                    </td>
                                    <td class="font-semibold text-center">
                                        <div class="product-name">{{ $product->name }}</div>
                                    </td>
                                    <td class="text-center">{{ $product->category->name ?? '-' }}</td>
                                    <td class="text-center">Rp{{ number_format($product->price,0,',','.') }}</td>
                                    <td class="text-center">
                                        @if($product->stock == 0)
                                            <span class="badge-glass habis"><i class="bi bi-x-octagon"></i> Habis</span>
                                        @elseif($product->stock <= 5)
                                            <span class="badge-glass menipis"><i class="bi bi-exclamation-triangle"></i> Stok Menipis ({{ $product->stock }})</span>
                                        @else
                                            <span class="badge-glass aman"><i class="bi bi-check-circle"></i> {{ $product->stock }}</span>
                                        @endif
                                    </td>
                                    <td class="min-w-[140px] text-center">
                                        <div class="flex flex-col sm:flex-row gap-2 w-full justify-center">
                                            <a href="{{ route('products.edit', $product) }}" class="btn-glass flex items-center justify-center gap-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                            <button type="button" data-id="{{ $product->id }}" data-name="{{ $product->name }}" onclick="showDeleteModal(this)" class="btn-glass flex items-center justify-center gap-1"><i class="bi bi-trash"></i> Hapus</button>
                                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-8 text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns='http://www.w3.org/2000/svg' class='h-16 w-16 mb-2' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 17v-2a4 4 0 014-4h2a4 4 0 014 4v2M7 7a4 4 0 110-8 4 4 0 010 8z' /></svg>
                                            <span class="text-lg font-semibold">Belum ada produk.<br>Yuk tambah produk baru!</span>
                                            <a href="{{ route('products.create') }}" class="mt-4 inline-block btn-glass"><i class="bi bi-plus-circle"></i> Tambah Produk</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal Konfirmasi Hapus -->
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="glass p-8 max-w-sm w-full transform scale-95 transition-transform duration-300">
            <div class="flex flex-col items-center">
                <i class="bi bi-exclamation-triangle text-4xl text-red-500 mb-2"></i>
                <h2 class="text-xl font-bold mb-2">Konfirmasi Hapus</h2>
                <p class="mb-4 text-center">Yakin ingin menghapus produk <span id="modal-product-name" class="font-semibold"></span>?</p>
                <div class="flex gap-2 w-full">
                    <button onclick="hideDeleteModal()" class="flex-1 btn-glass secondary">Batal</button>
                    <button id="modal-delete-btn" class="flex-1 btn-glass bg-red-500/80 hover:bg-red-600/90">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let deleteProductId = null;
        function showDeleteModal(btn) {
            deleteProductId = btn.getAttribute('data-id');
            document.getElementById('modal-product-name').textContent = btn.getAttribute('data-name');
            document.getElementById('delete-modal').classList.remove('hidden');
        }
        function hideDeleteModal() {
            deleteProductId = null;
            document.getElementById('delete-modal').classList.add('hidden');
        }
        document.getElementById('modal-delete-btn').onclick = function() {
            if (deleteProductId) {
                document.getElementById('delete-form-' + deleteProductId).submit();
            }
        };

        // Highlight baris aktif saat diklik
        const rows = document.querySelectorAll('.table-glass tbody tr');
        rows.forEach(row => {
            row.addEventListener('click', function(e) {
                rows.forEach(r => r.classList.remove('active-row'));
                this.classList.add('active-row');
            });
        });
    </script>
</body>
</html> 