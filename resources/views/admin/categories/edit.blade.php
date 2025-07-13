<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori | Admin FlashMart</title>
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
        .form-glass {
            background: rgba(30,41,59,0.85);
            color: #fff;
            border-radius: 1.2rem;
            padding: 2.5rem 2rem 2rem 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 40px 0 rgba(59,130,246,0.13);
            max-width: 420px;
            width: 100%;
        }
        .form-glass h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #60a5fa;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .input-glass {
            width: 100%;
            padding: 0.9rem 1.2rem;
            background: rgba(51,65,85,0.7);
            border: none;
            border-radius: 1rem;
            color: #fff;
            font-size: 1.1rem;
            margin-bottom: 0.2rem;
            transition: box-shadow 0.2s;
        }
        .input-glass:focus {
            outline: none;
            box-shadow: 0 0 0 2px #60a5fa;
        }
        .label-glass {
            position: absolute;
            left: 1.2rem;
            top: 1.1rem;
            color: #cbd5e1;
            font-size: 1rem;
            font-weight: 500;
            pointer-events: none;
            background: transparent;
            transition: all 0.2s;
        }
        .input-glass:focus + .label-glass,
        .input-glass:not(:placeholder-shown) + .label-glass {
            top: -1.1rem;
            left: 0.8rem;
            font-size: 0.85rem;
            color: #60a5fa;
            background: rgba(30,41,59,0.85);
            padding: 0 0.5rem;
            border-radius: 0.5rem;
        }
        .btn-glass {
            background: #3b82f6;
            color: #fff;
            border-radius: 1rem;
            padding: 0.8rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            box-shadow: 0 2px 8px 0 rgba(59,130,246,0.10);
            transition: background 0.15s;
        }
        .btn-glass.secondary {
            background: #64748b;
            color: #fff;
        }
        .btn-glass:hover {
            background: #2563eb;
        }
        .btn-glass.secondary:hover {
            background: #334155;
        }
        .danger-glass {
            background: rgba(239,68,68,0.13);
            color: #ef4444;
            border-radius: 0.8rem;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        .success-glass {
            background: rgba(34,197,94,0.13);
            color: #22c55e;
            border-radius: 0.8rem;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        @media (max-width: 900px) {
            .sidebar-glass { display: none; }
            .main-content-glass { margin-left: 0; }
        }
    </style>
</head>
<body class="min-h-screen flex bg-gradient-to-br from-[#232946] to-[#1a223f]">
    <!-- Sidebar -->
    <aside class="sidebar-glass flex flex-col items-center py-4 px-2 h-full min-h-screen">
        <div class="brand">
            <i class="bi bi-heart-pulse-fill text-blue-300"></i>
            <span class="hidden md:inline">Medcare</span>
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
        <div class="topbar-glass">
            <input type="text" class="searchbar-glass" placeholder="Search for events, patients, etc." />
            <div class="topbar-icons">
                <i class="bi bi-bell-fill text-2xl text-blue-200 cursor-pointer"></i>
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="topbar-avatar" />
            </div>
        </div>
        <div class="flex flex-col items-center justify-center flex-1">
            <form method="POST" action="{{ route('categories.update', $category) }}" class="form-glass relative">
                <h1><i class="bi bi-tags"></i> Edit Kategori</h1>
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="danger-glass"><i class="bi bi-exclamation-circle"></i> <span>{{ $errors->first() }}</span></div>
                @endif
                @if (session('success'))
                    <div class="success-glass"><i class="bi bi-check-circle"></i> <span>{{ session('success') }}</span></div>
                @endif
                <div class="mb-8 relative">
                    <input type="text" name="name" id="name" autofocus value="{{ old('name', $category->name) }}" class="input-glass peer" required placeholder=" " />
                    <label for="name" class="label-glass">Nama Kategori</label>
                    <span class="absolute right-3 top-2 text-xs text-blue-300" title="Nama kategori yang akan ditampilkan di toko."><i class="bi bi-info-circle"></i></span>
                    @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                </div>
                <div class="flex justify-between gap-2 mt-8">
                    <a href="{{ route('categories.index') }}" class="btn-glass secondary flex items-center gap-1"><i class="bi bi-arrow-left"></i> Kembali</a>
                    <button type="submit" id="submit-btn" class="btn-glass"><i class="bi bi-save"></i> <span id="btn-text">Simpan</span><span id="btn-spinner" class="hidden absolute right-3"><i class="bi bi-arrow-repeat animate-spin"></i></span></button>
                </div>
            </form>
        </div>
    </main>
    <script>
    document.getElementById('submit-btn').onclick = function() {
        document.getElementById('btn-text').classList.add('opacity-50');
        document.getElementById('btn-spinner').classList.remove('hidden');
    };
    </script>
</body>
</html> 