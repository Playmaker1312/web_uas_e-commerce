<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - FlashMart</title>
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
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors shadow-md">Logout</button>
            </form>
        </div>
    </header>
    <main class="flex-1 w-full max-w-xl mx-auto px-4 py-8 flex flex-col items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-8 w-full">
            <h1 class="text-2xl font-bold mb-6 text-blue-700 dark:text-blue-300 text-center">Profil Saya</h1>
            <div class="flex flex-col items-center gap-4">
                <div class="bg-blue-100 dark:bg-blue-900 rounded-full p-4 mb-2">
                    <i class="bi bi-person-circle text-5xl text-blue-600 dark:text-blue-300"></i>
                </div>
                <div class="w-full">
                    <div class="mb-2">
                        <span class="font-semibold">Nama:</span> {{ $user->name }}
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Email:</span> {{ $user->email }}
                    </div>
                    <div class="mb-2">
                        <span class="font-semibold">Role:</span> <span class="uppercase">{{ $user->role }}</span>
                    </div>
                </div>
                <a href="/home" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow-md">Kembali ke Home</a>
            </div>
        </div>
    </main>
</body>
</html> 