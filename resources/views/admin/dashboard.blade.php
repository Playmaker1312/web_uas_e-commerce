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
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex flex-col lg:flex-row">
    <!-- Sidebar -->
    <aside class="w-full lg:w-64 bg-blue-800 dark:bg-blue-950 text-white flex flex-col min-h-screen shadow-lg rounded-b-lg lg:rounded-b-none lg:rounded-r-lg">
        <div class="p-6 text-3xl font-bold border-b border-blue-700 dark:border-blue-800 flex items-center justify-center lg:justify-start gap-2">
            <i class="bi bi-lightning-fill text-blue-300"></i> <span class="hidden md:inline">Admin Panel</span>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="/dashboard" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-speedometer2 text-xl"></i> <span class="hidden md:inline">Dashboard</span>
            </a>
            <a href="/admin/products" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-box-seam text-xl"></i> <span class="hidden md:inline">Produk</span>
            </a>
            <a href="/admin/categories" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-tags text-xl"></i> <span class="hidden md:inline">Kategori</span>
            </a>
            <a href="/admin/orders" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-receipt text-xl"></i> <span class="hidden md:inline">Order</span>
            </a>
        </nav>
        <form action="/logout" method="POST" class="p-4 border-t border-blue-700 dark:border-blue-800">
            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition-colors shadow-md flex items-center justify-center gap-2">
                <i class="bi bi-box-arrow-right"></i> <span class="hidden md:inline">Logout</span>
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col items-start justify-start p-4 md:p-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="w-full max-w-6xl mx-auto"> <!-- Added mx-auto here -->
            <h1 class="text-3xl md:text-4xl font-bold mb-2 text-blue-700 dark:text-blue-300">Selamat Datang, Admin!</h1>
            <p class="text-base md:text-lg text-gray-600 dark:text-gray-400 mb-6">Gunakan sidebar di sebelah kiri untuk menavigasi fitur administrasi FlashMart.</p>

            <!-- Notifikasi Order Pending -->
            @if(count($orderPending) > 0)
            <div class="mb-6 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-lg flex items-center gap-3 shadow-md">
                <i class="bi bi-exclamation-circle-fill text-2xl"></i>
                <div>
                    <b>{{ count($orderPending) }} order baru</b> menunggu diproses!
                    <a href="/admin/orders" class="ml-2 underline text-blue-700 dark:text-blue-300 hover:text-blue-900 dark:hover:text-blue-100">Lihat Order</a>
                </div>
            </div>
            @endif

            <!-- Quick Action Buttons -->
            <div class="mb-8 flex flex-wrap gap-4 justify-start">
                <a href="/admin/products/create" class="btn btn-primary flex items-center gap-2 transform hover:scale-105">
                    <i class="bi bi-plus-circle"></i> Tambah Produk
                </a>
                <a href="/admin/categories/create" class="btn btn-secondary flex items-center gap-2 transform hover:scale-105">
                    <i class="bi bi-plus-circle"></i> Tambah Kategori
                </a>
                <a href="/admin/orders" class="btn btn-primary flex items-center gap-2 transform hover:scale-105">
                    <i class="bi bi-receipt"></i> Lihat Semua Order
                </a>
            </div>

            <!-- Grafik Penjualan 7 Hari Terakhir
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg mb-10 border border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold mb-4 text-blue-700 dark:text-blue-300 flex items-center gap-2">
                    <i class="bi bi-bar-chart-line-fill"></i> Grafik Penjualan 7 Hari Terakhir
                </h2>
                <canvas id="salesChart" height="80"></canvas>
            </div> -->

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                <div class="bg-blue-600 dark:bg-blue-800 text-white rounded-xl shadow-lg flex flex-col items-center justify-center py-6 hover:scale-105 transition-transform duration-200">
                    <i class="bi bi-cash-stack text-4xl mb-2"></i>
                    <div class="text-2xl font-bold mb-1">Rp{{ number_format($totalPenjualanHari,0,',','.') }}</div>
                    <div class="text-sm opacity-80">Penjualan Hari Ini</div>
                </div>
                <div class="bg-blue-400 dark:bg-blue-700 text-white rounded-xl shadow-lg flex flex-col items-center justify-center py-6 hover:scale-105 transition-transform duration-200">
                    <i class="bi bi-currency-dollar text-4xl mb-2"></i>
                    <div class="text-2xl font-bold mb-1">Rp{{ number_format($totalPenjualanBulan,0,',','.') }}</div>
                    <div class="text-sm opacity-80">Penjualan Bulan Ini</div>
                </div>
                <div class="bg-green-500 dark:bg-green-700 text-white rounded-xl shadow-lg flex flex-col items-center justify-center py-6 hover:scale-105 transition-transform duration-200">
                    <i class="bi bi-box-arrow-in-down text-4xl mb-2"></i>
                    <div class="text-2xl font-bold mb-1">{{ $orderBaru }}</div>
                    <div class="text-sm opacity-80">Order Baru Hari Ini</div>
                </div>
                <div class="bg-yellow-400 dark:bg-yellow-700 text-white rounded-xl shadow-lg flex flex-col items-center justify-center py-6 hover:scale-105 transition-transform duration-200">
                    <i class="bi bi-people-fill text-4xl mb-2"></i>
                    <div class="text-2xl font-bold mb-1">{{ $userCount }}</div>
                    <div class="text-sm opacity-80">Total User</div>
                </div>
            </div>

            <!-- Produk Terlaris & Stok Menipis -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg flex flex-col items-start border border-blue-100 dark:border-blue-900">
                    <h2 class="text-xl font-semibold mb-3 text-blue-700 dark:text-blue-300 flex items-center gap-2">
                        <i class="bi bi-star-fill text-yellow-500"></i> Produk Terlaris
                    </h2>
                    @if($produkTerlaris)
                        <div class="font-bold text-xl mb-1 text-gray-900 dark:text-gray-100">{{ $produkTerlaris->name }}</div>
                        <div class="text-gray-600 dark:text-gray-400 mb-1">Terjual: {{ $produkTerlaris->terjual ?? 0 }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Stok: {{ $produkTerlaris->stock ?? '-' }}</div>
                    @else
                        <div class="text-gray-500">Belum ada data produk terlaris.</div>
                    @endif
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg flex flex-col items-start border border-red-100 dark:border-red-900">
                    <h2 class="text-xl font-semibold mb-3 text-red-600 dark:text-red-400 flex items-center gap-2">
                        <i class="bi bi-exclamation-triangle-fill"></i> Stok Menipis (&lt; 5)
                    </h2>
                    @if(count($produkStokMenipis) > 0)
                        <ul class="list-disc pl-5 text-gray-700 dark:text-gray-300 space-y-1">
                            @foreach($produkStokMenipis as $p)
                                <li>{{ $p->name }} (Stok: {{ $p->stock }})</li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-gray-500">Tidak ada produk dengan stok menipis.</div>
                    @endif
                </div>
            </div>

            <!-- Order Terbaru -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg mb-10 border border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold mb-4 text-blue-700 dark:text-blue-300 flex items-center gap-2">
                    <i class="bi bi-clock-history"></i> 5 Order Terbaru
                </h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full main-table rounded-lg overflow-hidden">
                        <thead class="bg-blue-100 dark:bg-blue-900">
                            <tr>
                                <th class="px-4 py-2 text-left">Tanggal</th>
                                <th class="px-4 py-2 text-left">User</th>
                                <th class="px-4 py-2 text-left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orderTerbaru as $order)
                            <tr class="hover:bg-blue-50 dark:hover:bg-blue-800 transition">
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $order->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $order->user->name ?? '-' }}</td>
                                <td class="px-4 py-2 font-semibold text-blue-600 dark:text-blue-400">Rp{{ number_format($order->total,0,',','.') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="3" class="text-center text-gray-500 py-4">Belum ada order.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Chart.js Script (data dinamis) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil data dari backend
        const labels = {!! json_encode($days) !!};
        const data = {!! json_encode($sales) !!};

        // Cek dan render chart hanya jika canvas ada
        const canvas = document.getElementById('salesChart');
        if (!canvas) return;

        // Destroy chart jika sudah ada
        if (window.salesChartInstance) {
            window.salesChartInstance.destroy();
        }

        // Buat chart baru
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
