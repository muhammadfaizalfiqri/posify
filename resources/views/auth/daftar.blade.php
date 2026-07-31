<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSify | Register</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>

<body>

<div
class="min-h-screen bg-cover bg-center relative"
style="background-image:url('{{ asset('asset/background_login.avif') }}')">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-slate-950/70"></div>

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

                    Join

                    <span class="text-blue-400">
                        POSify
                    </span>

                    Today.

                </h2>

                <p class="mt-6 text-gray-300 text-lg leading-8">

                    Buat akun baru dan mulai kelola bisnis Anda
                    dengan sistem Point of Sale yang modern,
                    cepat, dan mudah digunakan.

                </p>

                <div class="mt-10 space-y-5">

                    <div class="flex gap-3 items-center">

                        <i class="fa-solid fa-circle-check text-blue-400"></i>

                        <span class="text-white">

                            Inventory Management

                        </span>

                    </div>

                    <div class="flex gap-3 items-center">

                        <i class="fa-solid fa-circle-check text-blue-400"></i>

                        <span class="text-white">

                            Sales Transaction

                        </span>

                    </div>

                    <div class="flex gap-3 items-center">

                        <i class="fa-solid fa-circle-check text-blue-400"></i>

                        <span class="text-white">

                            Sales Report

                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="w-full lg:w-1/2 flex justify-center items-center p-8">

            <div
            class="w-full max-w-md
            bg-white/10
            backdrop-blur-xl
            rounded-3xl
            border border-white/20
            shadow-2xl
            p-10">

                <div class="text-center">

                    <div
                    class="w-20 h-20 mx-auto rounded-full
                    bg-blue-600 flex items-center justify-center">

                        <i class="fa-solid fa-user-plus text-3xl text-white"></i>

                    </div>

                    <h2 class="mt-6 text-4xl font-bold text-white">

                        Create Account

                    </h2>

                    <p class="text-gray-300 mt-2">

                        Register to start using POSify

                    </p>

                </div>

                @if(session('success'))
                    <div class="mb-4 rounded-lg bg-green-500/20 border border-green-500 text-green-300 p-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-lg bg-red-500/20 border border-red-500 text-red-300 p-3">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('daftar.store') }}" method="POST" class="mt-8 space-y-5">

                    @csrf

                    <!-- Full Name -->
                    <div>
                        <label class="text-gray-300 text-sm">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your name"
                            class="w-full mt-2 rounded-xl px-4 py-3 bg-white/10 border border-white/20 text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 outline-none">

                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div>
                        <label class="text-gray-300 text-sm">
                            Username
                        </label>

                        <input
                            type="text"
                            name="username"
                            value="{{ old('username') }}"
                            placeholder="Choose username"
                            class="w-full mt-2 rounded-xl px-4 py-3 bg-white/10 border border-white/20 text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 outline-none">

                        @error('username')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-gray-300 text-sm">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter email"
                            class="w-full mt-2 rounded-xl px-4 py-3 bg-white/10 border border-white/20 text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 outline-none">

                        @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-gray-300 text-sm">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            placeholder="Create password"
                            class="w-full mt-2 rounded-xl px-4 py-3 bg-white/10 border border-white/20 text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 outline-none">

                        @error('password')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="text-gray-300 text-sm">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            placeholder="Repeat password"
                            class="w-full mt-2 rounded-xl px-4 py-3 bg-white/10 border border-white/20 text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>

                    <button
                        type="submit"
                        class="w-full py-3 rounded-xl bg-blue-600 hover:bg-blue-700 transition-all duration-300 font-semibold text-white">

                        <i class="fa-solid fa-user-plus mr-2"></i>
                        Register

                    </button>

                    <div class="border-t border-white/10 pt-5 text-center">

                        <p class="text-gray-300">

                            Sudah punya akun?

                            <a
                                href="{{ route('login') }}"
                                class="text-blue-400 hover:text-blue-300 font-semibold">

                                Login

                            </a>

                        </p>

                    </div>

                </form>

            </div>

        </div>

    </div>