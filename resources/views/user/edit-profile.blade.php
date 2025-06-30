<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - FlashMart</title>
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
            <h1 class="text-2xl font-bold mb-6 text-blue-700 dark:text-blue-300 text-center">Edit Profil</h1>
            <form method="POST" action="{{ route('user.profile.update') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block font-semibold mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                    @error('name')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="block font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white" required>
                    @error('email')<div class="text-red-600 text-sm mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="flex justify-between mt-6">
                    <a href="{{ route('user.profile') }}" class="bg-gray-400 text-white px-6 py-2 rounded-lg hover:bg-gray-500 transition shadow-md">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow-md">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html> 