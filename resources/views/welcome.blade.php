<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlashMart - Toko Online Pilihan Anda</title>

    <!-- Fonts: Menggunakan Inter, mirip dengan Instrument Sans -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gaya kustom untuk estetika dan font yang lebih baik */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Memastikan sudut membulat pada semua elemen sesuai instruksi */
        .rounded-element {
            border-radius: 0.5rem; /* Setara dengan rounded-lg */
        }
        .btn {
            @apply px-5 py-1.5 rounded-sm font-medium transition-all duration-300;
        }
        .btn-primary {
            @apply bg-blue-600 text-white hover:bg-blue-700 shadow-md;
        }
        .btn-secondary {
            @apply bg-gray-200 text-gray-800 hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600 shadow-sm;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">

    <!-- Header Section (header kini kosong dari tombol login/register) -->
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
        <!-- Navigasi header kini kosong karena tombol dipindahkan -->
        <nav class="flex items-center justify-end gap-4">
            <!-- Tombol login/register telah dipindahkan ke bagian kanan -->
        </nav>
    </header>

    <!-- Main Content Area: Card besar dengan logo dan penjelasan, serta daftar link -->
    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row lg:items-stretch">
            <!-- Bagian Kiri: Penjelasan dan Link -->
            <div class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-gray-800 dark:text-gray-100 shadow-md rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                <h1 class="mb-2 font-bold text-2xl md:text-3xl text-blue-700 dark:text-blue-300">Temukan Kebutuhan Anda di FlashMart!</h1>
                <p class="mb-4 text-gray-600 dark:text-gray-400">
                    FlashMart adalah destinasi belanja online terpercaya Anda. Kami menawarkan beragam produk berkualitas tinggi dengan harga kompetitif, didukung layanan pelanggan yang prima. Mulai petualangan belanja Anda sekarang!
                </p>
                <ul class="flex flex-col mb-4 lg:mb-6 space-y-2">
                    <li class="flex items-center gap-3 py-1 relative before:border-l before:border-gray-300 dark:before:border-gray-700 before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute">
                        <span class="relative py-1 bg-white dark:bg-gray-800">
                            <!-- Icon for Explore All Products -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-blue-500 dark:text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </span>
                        <a href="#" class="inline-block hover:underline underline-offset-4 text-gray-800 dark:text-gray-200 text-base leading-normal">
                            Jelajahi Semua Produk
                        </a>
                    </li>
                    <li class="flex items-center gap-3 py-1 relative before:border-l before:border-gray-300 dark:before:border-gray-700 before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute">
                        <span class="relative py-1 bg-white dark:bg-gray-800">
                            <!-- Icon for Popular Categories -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-green-500 dark:text-green-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.403-1.086C2.92 13.021 6.337 12 9.53 12h.5c.342 0 .67.016 1 .042M9.53 16.122v-3.35M9.53 16.122c-1.04 0-2.047-.152-3-.462maz-3.5-2.083a.75.75 0 0 1 1-.708 3.5 3.5 0 0 0 5.25 0 .75.75 0 0 1 1 .708m-4.5 0a.75.75 0 0 0-1.5 0" />
                            </svg>
                        </span>
                        <a href="#" class="inline-block hover:underline underline-offset-4 text-gray-800 dark:text-gray-200 text-base leading-normal">
                            Kategori Populer
                        </a>
                    </li>
                    <li class="flex items-center gap-3 py-1 relative before:border-l before:border-gray-300 dark:before:border-gray-700 before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute">
                        <span class="relative py-1 bg-white dark:bg-gray-800">
                            <!-- Icon for Special Offers -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-red-500 dark:text-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.529 11.121A.75.75 0 0 1 10 11.25h4a.75.75 0 0 1 .471.121l3.193 2.554c.195.156.292.406.292.659v4.062c.004.26-.08.51-.234.703a.75.75 0 0 1-.58.26H6.912a.75.75 0 0 1-.58-.26.75.75 0 0 1-.234-.703v-4.062c0-.253.097-.503.292-.659l3.193-2.554Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.75a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0V10.5a.75.75 0 0 1 .75-.75Z" />
                            </svg>
                        </span>
                        <a href="#" class="inline-block hover:underline underline-offset-4 text-gray-800 dark:text-gray-200 text-base leading-normal">
                            Penawaran Spesial
                        </a>
                    </li>
                    <li class="flex items-center gap-3 py-1 relative before:border-l before:border-gray-300 dark:before:border-gray-700 before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute">
                        <span class="relative py-1 bg-white dark:bg-gray-800">
                            <!-- Icon for Help & FAQ -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-yellow-500 dark:text-yellow-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712L12 15l-2.121-2.121c-1.172-1.025-1.172-2.687 0-3.712Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12c0-5.625 5.25-10.125 11.25-10.125 5.999 0 11.25 4.5 11.25 10.125 0 5.625-5.25 10.125-11.25 10.125S2.25 17.625 2.25 12Z" />
                            </svg>
                        </span>
                        <a href="#" class="inline-block hover:underline underline-offset-4 text-gray-800 dark:text-gray-200 text-base leading-normal">
                            Bantuan & FAQ
                        </a>
                    </li>
                </ul>
                <div class="pb-12 mt-4 space-y-2 text-gray-600 dark:text-gray-400 text-sm lg:text-[13px] leading-normal lg:leading-[20px] transition-all duration-750 delay-300 starting:translate-y-6">
                    <p>
                        FlashMart adalah platform e-commerce yang didedikasikan untuk menyediakan pengalaman belanja online yang mudah dan menyenangkan. Kami percaya bahwa setiap orang berhak mendapatkan produk berkualitas dengan harga terbaik.
                    </p>
                    <p>
                        Jelajahi koleksi kami yang terus bertambah dan temukan apa yang Anda cari. Jika Anda siap untuk mulai berbelanja, kunjungi halaman
                        <a href="#" class="underline underline-offset-4 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200">
                            Produk Kami
                        </a>.
                    </p>
                </div>
            </div>

            <!-- Bagian Kanan: Logo FlashMart, Penjelasan Singkat, dan Tombol Login/Register -->
            <div class="flex-1 w-full flex justify-center items-center shrink-0 mb-6 lg:mb-0 transition-all duration-750 starting:translate-y-4 rounded-t-lg lg:rounded-tr-none lg:rounded-bl-none lg:rounded-tl-lg lg:rounded-r-lg bg-blue-100 dark:bg-blue-900 shadow-md relative overflow-hidden">
                <div class="relative w-full h-full flex items-center justify-center flex-col p-4">
                    <!-- Logo FlashMart (bisa diganti dengan gambar logo asli) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32 text-blue-600 dark:text-blue-400 mb-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H9M2.25 10.5h19.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H2.25A2.25 2.25 0 0 0 0 6.75v1.5A2.25 2.25 0 0 0 2.25 10.5Zm7.5-7.5h6m-3 0V.75M9 21h6" />
                    </svg>
                    <h2 class="text-3xl font-bold text-blue-800 dark:text-blue-200 mb-2">FlashMart</h2>
                    <p class="text-center text-blue-700 dark:text-blue-300 text-base mb-6">
                        Temukan produk terbaik untuk kebutuhan Anda!
                    </p>

                    <!-- Tombol Login dan Register dipindahkan ke sini -->
                    <div class="flex items-center justify-center gap-4">
                        <a
                            href="/login"
                            class="btn btn-secondary text-gray-900 dark:text-gray-100 border border-transparent hover:border-gray-300 dark:hover:border-gray-700"
                        >
                            Masuk
                        </a>
                        <a
                            href="/register"
                            class="btn btn-primary"
                        >
                            Daftar
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer Section (opsional, bisa ditambahkan jika diperlukan) -->
    <!-- Saya tidak menyertakan footer lengkap di sini untuk menjaga fokus pada struktur utama yang diminta,
         tetapi Anda bisa menambahkan kembali bagian footer dari kode sebelumnya jika diinginkan. -->
</body>
</html>
