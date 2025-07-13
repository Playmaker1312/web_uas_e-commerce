<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori | Admin FlashMart</title>
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
        .topbar-glass {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            gap: 1.5rem;
        }
        .searchbar-glass {
            flex: 1;
            background: rgba(51,65,85,0.7);
            border-radius: 1.5rem;
            padding: 0.7rem 1.5rem;
            color: #fff;
            font-size: 1.1rem;
            border: none;
            outline: none;
            box-shadow: none;
            margin-right: 1.5rem;
        }
        .topbar-icons {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .topbar-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #64748b;
        }
        .main-glass-card {
            background: rgba(30,41,59,0.85);
            color: #fff;
            border-radius: 1.2rem;
            padding: 2rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 16px 0 rgba(59,130,246,0.10);
        }
        .btn-glass {
            @apply px-4 py-2 rounded-lg font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors text-sm flex items-center gap-2 shadow-none border-none;
        }
        .btn-glass.secondary {
            @apply bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600;
        }
        .badge-glass {
            @apply inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-200;
        }
        .input-flat {
            @apply w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white text-sm;
        }
        .empty-state-glass {
            @apply flex flex-col items-center justify-center py-10 text-gray-400;
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
<body class="min-h-screen flex bg-gradient-to-br from-[#232946] to-[#1a223f]">
    <!-- Sidebar -->
    <aside class="sidebar-glass flex flex-col items-center py-4 px-2 h-full min-h-screen">
        <div class="brand">
            <i class="bi bi-cart-fill text-blue-300"></i>
            <span class="hidden md:inline">FlashMart</span>
        </div>
        <nav class="flex-1 w-full mt-4">
            <a href="/dashboard"><i class="bi bi-house-door-fill"></i> <span class="hidden md:inline">Dashboard</span></a>
            <a href="/admin/products"><i class="bi bi-box-seam"></i> <span class="hidden md:inline">Produk</span></a>
            <a href="/admin/categories" class="active"><i class="bi bi-tags"></i> <span class="hidden md:inline">Kategori</span></a>
            <a href="/admin/orders"><i class="bi bi-receipt"></i> <span class="hidden md:inline">Order</span></a>
        </nav>
        <div class="logout w-full">
            <form action="/logout" method="POST">
                <button type="submit"><i class="bi bi-box-arrow-right"></i> <span class="hidden md:inline">Logout</span></button>
            </form>
        </div>
    </aside>
    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-h-screen px-2 md:px-8 py-4">
        <!-- Topbar -->
        <div class="topbar-glass">
            <input type="text" class="searchbar-glass" placeholder="Cari kategori..." />
            <div class="topbar-icons">
                <i class="bi bi-bell-fill text-2xl text-blue-200 cursor-pointer"></i>
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="topbar-avatar" />
            </div>
        </div>
        <div class="main-glass-card">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <h1 class="text-3xl md:text-4xl font-bold flex items-center gap-3">
                    <i class="bi bi-tags"></i> Daftar Kategori
                </h1>
            </div>
            <form method="GET" class="search-glass-card relative mb-8">
                
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kategori..." class="searchbar-glass-2" />
                <button type="submit" class="btn-glass flex items-center gap-2"><i class="bi bi-search"></i> Cari</button>
                <a href="{{ route('categories.create') }}" class="add-btn-glass flex items-center gap-2"><i class="bi bi-plus-circle"></i> Tambah Kategori</a>
            </form>
            @if(session('success'))
                <div class="notification success"><i class="bi bi-check-circle"></i> <span>{{ session('success') }}</span></div>
            @endif
            @if(session('error'))
                <div class="notification error"><i class="bi bi-x-circle"></i> <span>{{ session('error') }}</span></div>
            @endif
            <div class="table-glass p-6">
                <div class="overflow-x-auto">
                    <table class="table-glass">
                        <thead>
                            <tr>
                                <th style="width:60%">Nama Kategori</th>
                                <th style="width:40%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr class="transition-all duration-200 hover:bg-blue-100/40 dark:hover:bg-blue-900/40">
                                    <td class="font-semibold text-center">
                                        {{ $category->name }}
                                        @if(isset($category->products_count))
                                            <span class="ml-2 inline-flex items-center gap-1 bg-blue-100/80 text-blue-700 px-2.5 py-0.5 rounded-full text-xs font-semibold cursor-pointer group relative shadow-sm" title="Jumlah produk">
                                                <i class="bi bi-box-seam"></i> {{ $category->products_count }} produk
                                                <span class="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 shadow-lg whitespace-nowrap">Jumlah produk dalam kategori ini</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td class="min-w-[140px] text-center">
                                        <div class="flex flex-col sm:flex-row gap-2 w-full justify-center">
                                            <a href="{{ route('categories.edit', $category) }}" class="btn-glass flex items-center justify-center gap-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                            <button type="button" data-id="{{ $category->id }}" data-name="{{ $category->name }}" onclick="showDeleteModal(this)" class="btn-glass flex items-center justify-center gap-1"><i class="bi bi-trash"></i> Hapus</button>
                                        </div>
                                        <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category) }}" method="POST" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-8 text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns='http://www.w3.org/2000/svg' class='h-12 w-12 mb-2' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7M16 3H8a2 2 0 00-2 2v2h12V5a2 2 0 00-2-2z' /></svg>
                                            <span>Belum ada kategori.</span>
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
    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden transition-opacity duration-300 opacity-0">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-8 max-w-sm w-full border border-gray-200 dark:border-gray-700 transform scale-95 transition-transform duration-300">
            <div class="flex flex-col items-center">
                <i class="bi bi-exclamation-triangle text-5xl text-red-500 mb-4 animate-bounce-in"></i>
                <h2 class="text-2xl font-bold mb-3 text-gray-900 dark:text-gray-100">Konfirmasi Hapus</h2>
                <p class="mb-6 text-center text-gray-700 dark:text-gray-300">Yakin ingin menghapus kategori <span id="modal-category-name" class="font-semibold text-blue-600 dark:text-blue-400"></span>?</p>
                <div class="flex gap-3 w-full">
                    <button onclick="hideDeleteModal()" class="flex-1 bg-gray-200 text-gray-800 px-5 py-2.5 rounded-lg hover:bg-gray-300 transition-colors font-medium">Batal</button>
                    <button id="modal-delete-btn" class="flex-1 bg-red-600 text-white px-5 py-2.5 rounded-lg hover:bg-red-700 transition-colors font-medium">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let deleteCategoryId = null;
        function showDeleteModal(btn) {
            deleteCategoryId = btn.getAttribute('data-id');
            document.getElementById('modal-category-name').textContent = btn.getAttribute('data-name');
            const modal = document.getElementById('delete-modal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.querySelector('.transform').classList.remove('scale-95');
            }, 10);
        }
        function hideDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('opacity-0');
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                deleteCategoryId = null;
            }, 300); // Match transition duration
        }
        document.getElementById('modal-delete-btn').onclick = function() {
            if (deleteCategoryId) {
                document.getElementById('delete-form-' + deleteCategoryId).submit();
            }
        };

        // Close modal on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                hideDeleteModal();
            }
        });
    </script>
</body>
</html>