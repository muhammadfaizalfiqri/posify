<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POSify | Login</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
</head>

<body>

    <div class="min-h-screen bg-cover bg-center relative"
        style="background-image:url('{{ asset('asset/background_login.avif') }}')">

        <!-- Overlay -->

        <div class="absolute inset-0 bg-slate-950/70"></div>

        <!-- Content -->

        <div class="relative z-10 min-h-screen flex">

            <!-- LEFT -->

            <div class="hidden lg:flex w-1/2 items-center px-20">

                <div>

                    <div class="flex items-center gap-4 mb-8">

                        <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center">

                            <i class="fa-solid fa-cart-shopping text-3xl text-white"></i>

                        </div>

                        <div>

                            <h1 class="text-5xl font-bold text-white">

                                POSify

                            </h1>

                            <p class="text-blue-300">

                                Modern Point of Sale

                            </p>

                        </div>

                    </div>

                    <h2 class="text-5xl font-bold text-white leading-tight">

                        Manage Your
                        <span class="text-blue-400">

                            Business

                        </span>

                        Smarter.

                    </h2>

                    <p class="mt-6 text-gray-300 text-lg leading-8">

                        POSify membantu Anda mengelola transaksi,
                        stok barang, supplier, hingga laporan penjualan
                        dalam satu aplikasi yang modern dan mudah digunakan.

                    </p>

                    <div class="mt-10 space-y-5">

                        <div class="flex items-center gap-3">

                            <i class="fa-solid fa-circle-check text-blue-400 text-xl"></i>

                            <span class="text-white">

                                Inventory Management

                            </span>

                        </div>

                        <div class="flex items-center gap-3">

                            <i class="fa-solid fa-circle-check text-blue-400 text-xl"></i>

                            <span class="text-white">

                                Sales Transaction

                            </span>

                        </div>

                        <div class="flex items-center gap-3">

                            <i class="fa-solid fa-circle-check text-blue-400 text-xl"></i>

                            <span class="text-white">

                                Sales Report

                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="w-full lg:w-1/2 flex justify-center items-center p-8">

                <div class="w-full max-w-md
            bg-white/10
            backdrop-blur-xl
            rounded-3xl
            border border-white/20
            shadow-2xl
            p-10">

                    <div class="text-center">

                        <div class="w-20 h-20 mx-auto rounded-full
                    bg-blue-600 flex items-center justify-center">

                            <i class="fa-solid fa-user-lock text-3xl text-white"></i>

                        </div>

                        <h2 class="mt-6 text-4xl font-bold text-white">

                            Welcome

                        </h2>

                        <p class="text-gray-300 mt-2">

                            Login to continue using POSify

                        </p>

                    </div>

                    <form action="{{ route('login.store') }}" method="POST" class="mt-10 space-y-6">

                        @csrf

                        {{-- Error Login --}}
                        @if ($errors->any())
                        <div class="bg-red-500/20 border border-red-500 text-red-200 rounded-xl p-3">
                            {{ $errors->first() }}
                        </div>
                        @endif

                        <!-- Username -->
                        <div>

                            <label class="text-gray-300 text-sm">

                                Username

                            </label>

                            <div class="relative mt-2">

                                <i class="fa-solid fa-user
                                        absolute
                                        left-4
                                        top-1/2
                                        -translate-y-1/2
                                        text-gray-400">
                                </i>

                                <input type="text" name="username" value="{{ old('username') }}"
                                    placeholder="Enter username" class="w-full
                                        rounded-xl
                                        pl-12
                                        pr-4
                                        py-3
                                        bg-white/10
                                        border
                                        border-white/20
                                        text-white
                                        placeholder:text-gray-400
                                        focus:ring-2
                                        focus:ring-blue-500
                                        outline-none">

                            </div>

                        </div>

                        <!-- Password -->
                        <div>

                            <label class="text-gray-300 text-sm">

                                Password

                            </label>

                            <div class="relative mt-2">

                                <i class="fa-solid fa-lock
                                        absolute
                                        left-4
                                        top-1/2
                                        -translate-y-1/2
                                        text-gray-400">
                                </i>

                                <input type="password" name="password" placeholder="Enter password" class="w-full
                                        rounded-xl
                                        pl-12
                                        pr-4
                                        py-3
                                        bg-white/10
                                        border
                                        border-white/20
                                        text-white
                                        placeholder:text-gray-400
                                        focus:ring-2
                                        focus:ring-blue-500
                                        outline-none">

                            </div>

                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex justify-between text-sm">

                            <label class="flex items-center gap-2 text-gray-300">

                                <input type="checkbox" name="remember">

                                Remember Me

                            </label>

                            <a href="#" class="text-blue-400 hover:text-blue-300">

                                Forgot Password?

                            </a>

                        </div>

                        <!-- Button Login -->
                        <button type="submit" class="w-full
                                py-3
                                rounded-xl
                                bg-blue-600
                                hover:bg-blue-700
                                duration-300
                                text-white
                                font-semibold
                                shadow-lg">

                            Login

                        </button>

                        <!-- Register -->
                        <div class="mt-6 text-center">

                            <p class="text-gray-300">

                                Belum punya akun?

                                <a href="{{ route('daftar') }}" class="text-blue-400 hover:text-blue-300 font-semibold">

                                    Daftar sekarang

                                </a>

                            </p>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>

</html>