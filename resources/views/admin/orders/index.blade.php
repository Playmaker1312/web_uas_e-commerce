<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Order | Admin FlashMart</title>
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
            <a href="/admin/products" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-box-seam text-xl"></i> <span class="hidden md:inline">Produk</span>
            </a>
            <a href="/admin/categories" class="block py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors flex items-center gap-3">
                <i class="bi bi-tags text-xl"></i> <span class="hidden md:inline">Kategori</span>
            </a>
            <a href="/admin/orders" class="block py-2 px-4 rounded-lg bg-blue-700 dark:bg-blue-800 transition-colors flex items-center gap-3">
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
        <div class="w-full max-w-7xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold mb-6 text-blue-700 dark:text-blue-300 flex items-center gap-3">
                <i class="bi bi-receipt"></i> Daftar Order
            </h1>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full main-table rounded-lg overflow-hidden">
                        <thead class="bg-blue-100 dark:bg-blue-900">
                            <tr>
                                <th>User</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Alamat</th>
                                <th>Detail Item</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->name ?? '-' }}</td>
                                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                                    <td>Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusColor = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'proses' => 'bg-blue-100 text-blue-800',
                                                'selesai' => 'bg-green-100 text-green-800',
                                                'batal' => 'bg-red-100 text-red-800',
                                            ][$order->status ?? 'pending'] ?? 'bg-gray-200 text-gray-800';
                                        @endphp
                                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $statusColor }} capitalize">{{ $order->status ?? 'pending' }}</span>
                                    </td>
                                    <td class="max-w-xs truncate" title="{{ $order->shipping_address }}">{{ $order->shipping_address ?? '-' }}</td>
                                    <td>
                                        <ul class="list-disc pl-5 text-sm">
                                            @foreach ($order->items as $item)
                                                <li>
                                                    {{ $item->product->name ?? '-' }} (x{{ $item->quantity }}) - Rp{{ number_format($item->price, 0, ',', '.') }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="flex flex-col gap-2 min-w-[90px]">
                                        <form action="{{ route('orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Yakin hapus order?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 flex items-center gap-1"><i class="bi bi-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-8 text-gray-400">
                                        <i class="bi bi-inbox text-3xl mb-2"></i><br>Belum ada order.
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