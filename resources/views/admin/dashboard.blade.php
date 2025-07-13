<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard FlashMart</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tambahkan style untuk glassmorphism, sidebar, topbar, card, dsb -->
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
        .dashboard-content {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 2rem;
            margin-top: 1.5rem;
        }
        @media (max-width: 1024px) {
            .dashboard-content {
                grid-template-columns: 1fr;
            }
        }
        .hero-card-glass {
            background: linear-gradient(120deg, #3b82f6 0%, #6366f1 100%);
            color: #fff;
            border-radius: 2rem;
            padding: 2.2rem 2rem 2rem 2rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            box-shadow: 0 8px 40px 0 rgba(59,130,246,0.13);
            min-height: 140px;
        }
        .hero-card-glass .hero-img {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 2px 16px 0 rgba(59,130,246,0.10);
        }
        .stat-cards-glass {
            display: flex;
            gap: 1.2rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .stat-card-glass {
            flex: 1 1 0;
            min-width: 160px;
            background: rgba(30,41,59,0.85);
            color: #fff;
            border-radius: 1.2rem;
            padding: 1.2rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
            box-shadow: 0 2px 16px 0 rgba(59,130,246,0.10);
        }
        .stat-card-glass .icon {
            font-size: 2rem;
            margin-bottom: 0.2rem;
            color: #60a5fa;
        }
        .stat-card-glass .value {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .stat-card-glass .label {
            font-size: 0.9rem;
            color: #cbd5e1;
        }
        .profile-card-glass, .calendar-card-glass {
            background: rgba(30,41,59,0.85);
            color: #fff;
            border-radius: 1.2rem;
            padding: 1.5rem 1.2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 16px 0 rgba(59,130,246,0.10);
        }
        .profile-card-glass .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #6366f1;
            margin-bottom: 0.7rem;
        }
        .calendar-card-glass .calendar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        .calendar-card-glass .calendar-days {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .calendar-card-glass .calendar-day {
            width: 32px;
            height: 32px;
            border-radius: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #cbd5e1;
            background: none;
            transition: background 0.15s, color 0.15s;
        }
        .calendar-card-glass .calendar-day.active {
            background: #6366f1;
            color: #fff;
        }
        .calendar-card-glass .calendar-events {
            font-size: 0.95rem;
            color: #cbd5e1;
        }
        .chart-card-glass {
            background: rgba(30,41,59,0.85);
            color: #fff;
            border-radius: 1.2rem;
            padding: 1.5rem 1.2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 16px 0 rgba(59,130,246,0.10);
        }
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
        /* Table styling for main content area */
        .main-table th, .main-table td {
            @apply px-4 py-3 text-left border-b border-gray-200 dark:border-gray-700;
        }
        .main-table thead th {
            @apply bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold uppercase text-sm;
        }
        .main-table tbody tr:hover {
            @apply bg-gray-50 dark:bg-gray-700;
        }
        .sidebar-flat {
            @apply bg-blue-600 dark:bg-blue-900 text-white w-16 md:w-56 flex flex-col min-h-screen transition-all duration-200;
        }
        .sidebar-flat .brand {
            @apply flex items-center justify-center md:justify-start gap-2 px-4 py-5 text-xl font-bold border-b border-blue-700 dark:border-blue-800;
        }
        .sidebar-flat nav a {
            @apply flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors text-base font-medium;
        }
        .sidebar-flat nav a.active {
            @apply bg-blue-700 dark:bg-blue-800;
        }
        .sidebar-flat .logout {
            @apply mt-auto px-4 py-3 border-t border-blue-700 dark:border-blue-800;
        }
        .sidebar-flat .logout button {
            @apply w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg font-medium transition-colors;
        }
        .main-flat {
            @apply flex-1 p-4 md:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen;
        }
        .header-flat {
            @apply text-2xl md:text-3xl font-bold mb-4 text-blue-700 dark:text-blue-200;
        }
        .card-flat {
            @apply bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 mb-6;
        }
        .stat-card {
            @apply flex flex-col items-center justify-center bg-blue-50 dark:bg-blue-950 border border-blue-100 dark:border-blue-800 rounded-lg p-4 mb-0;
        }
        .stat-card .icon {
            @apply text-3xl mb-2 text-blue-500 dark:text-blue-300;
        }
        .stat-card .value {
            @apply text-xl font-bold mb-1 text-blue-900 dark:text-blue-100;
        }
        .stat-card .label {
            @apply text-xs text-gray-500 dark:text-gray-400;
        }
        .main-table-flat {
            @apply w-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden mt-2;
            border-collapse: separate;
            border-spacing: 0;
        }
        .main-table-flat th {
            @apply bg-blue-100 dark:bg-blue-900 text-gray-700 dark:text-gray-200 font-semibold uppercase text-xs py-3 px-4 border-b border-gray-200 dark:border-gray-700;
        }
        .main-table-flat td {
            @apply py-3 px-4 border-b border-gray-100 dark:border-gray-800 text-sm align-middle;
        }
        .main-table-flat tr:nth-child(even) td {
            @apply bg-gray-50 dark:bg-gray-800;
        }
        .main-table-flat tr:last-child td {
            @apply border-b-0;
        }
        .btn-flat {
            @apply px-4 py-2 rounded-lg font-medium bg-blue-600 text-white hover:bg-blue-700 transition-colors text-sm flex items-center gap-2 shadow-none border-none;
        }
        .btn-flat.secondary {
            @apply bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600;
        }
        .badge-flat {
            @apply inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-semibold bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-200;
        }
        .input-flat {
            @apply w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-white text-sm;
        }
        .form-label-flat {
            @apply block text-xs font-semibold mb-1 text-gray-600 dark:text-gray-300;
        }
        .empty-state-flat {
            @apply flex flex-col items-center justify-center py-10 text-gray-400;
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
            <a href="/dashboard" class="active"><i class="bi bi-house-door-fill"></i> <span class="hidden md:inline">Dashboard</span></a>
            <a href="/admin/products"><i class="bi bi-box-seam"></i> <span class="hidden md:inline">Produk</span></a>
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
    <main class="flex-1 flex flex-col min-h-screen px-2 md:px-8 py-6" style="background:linear-gradient(135deg,#1a223f 0%,#232946 100%);">
        <!-- Header Atas -->
        <div class="flex items-center gap-4 mb-8">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="w-12 h-12 rounded-full border-2 border-blue-700 shadow-sm" />
            <div class="text-2xl font-bold text-white">Halo, Admin</div>
        </div>
        <!-- 4 Card Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-[#232946] rounded-xl shadow p-5 flex flex-col items-start">
                <div class="text-sm text-gray-400 mb-1">Penjualan Hari Ini</div>
                <div class="text-2xl font-bold text-blue-400">Rp{{ number_format($salesToday ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="bg-[#232946] rounded-xl shadow p-5 flex flex-col items-start">
                <div class="text-sm text-gray-400 mb-1">Total Order</div>
                <div class="text-2xl font-bold text-blue-400">{{ $ordersCount ?? 0 }}</div>
            </div>
            <div class="bg-[#232946] rounded-xl shadow p-5 flex flex-col items-start">
                <div class="text-sm text-gray-400 mb-1">Total Produk</div>
                <div class="text-2xl font-bold text-blue-400">{{ $productsCount ?? 0 }}</div>
            </div>
            <div class="bg-[#232946] rounded-xl shadow p-5 flex flex-col items-start">
                <div class="text-sm text-gray-400 mb-1">Total User</div>
                <div class="text-2xl font-bold text-blue-400">{{ $usersCount ?? 0 }}</div>
            </div>
        </div>
        <!-- 3 Tabel Ringkasan -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Order Terbaru -->
            <div class="bg-[#232946] rounded-xl shadow p-5">
                <div class="font-bold text-white mb-3">Order Terbaru</div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-200">
                        <thead class="bg-[#1a223f] text-blue-200">
                            <tr>
                                <th class="py-2 px-3">Customer</th>
                                <th class="py-2 px-3">Tanggal</th>
                                <th class="py-2 px-3">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders ?? [] as $order)
                            <tr class="even:bg-[#20263a]">
                                <td class="py-2 px-3">{{ $order->user->name ?? '-' }}</td>
                                <td class="py-2 px-3">{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td class="py-2 px-3">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-gray-400 py-4">Belum ada order.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Produk Terlaris -->
            <div class="bg-[#232946] rounded-xl shadow p-5">
                <div class="font-bold text-white mb-3">Produk Terlaris</div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-200">
                        <thead class="bg-[#1a223f] text-blue-200">
                            <tr>
                                <th class="py-2 px-3">Nama Produk</th>
                                <th class="py-2 px-3">Terjual</th>
                                <th class="py-2 px-3">Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bestProducts ?? [] as $product)
                            <tr class="even:bg-[#20263a]">
                                <td class="py-2 px-3">{{ $product->name }}</td>
                                <td class="py-2 px-3">{{ $product->sold_count ?? 0 }}</td>
                                <td class="py-2 px-3">{{ $product->stock ?? 0 }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-gray-400 py-4">Belum ada produk.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- User Terbaru -->
            <div class="bg-[#232946] rounded-xl shadow p-5">
                <div class="font-bold text-white mb-3">User Terbaru</div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-200">
                        <thead class="bg-[#1a223f] text-blue-200">
                            <tr>
                                <th class="py-2 px-3">Nama</th>
                                <th class="py-2 px-3">Email</th>
                                <th class="py-2 px-3">Bergabung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentUsers ?? [] as $user)
                            <tr class="even:bg-[#20263a]">
                                <td class="py-2 px-3">{{ $user->name }}</td>
                                <td class="py-2 px-3">{{ $user->email }}</td>
                                <td class="py-2 px-3">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-gray-400 py-4">Belum ada user baru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        window.dashboardLabels = JSON.parse('@json($days ?? [])');
        window.dashboardData = JSON.parse('@json($sales ?? [])');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var labels = window.dashboardLabels;
        var data = window.dashboardData;
        var canvas = document.getElementById('salesChart');
        if (!canvas) return;
        if (window.salesChartInstance) {
            window.salesChartInstance.destroy();
        }
        window.salesChartInstance = new Chart(canvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: data,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    title: { display: false }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { color: 'rgb(107, 114, 128)' }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(229, 231, 235, 0.2)' },
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + value.toLocaleString('id-ID');
                            },
                            color: 'rgb(107, 114, 128)'
                        }
                    }
                }
            }
        });
    });
    </script>
</body>
</html>
