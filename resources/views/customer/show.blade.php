@extends('layouts.app')

@section('title', 'Detail Customer')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Detail Customer

            </h1>

            <p class="text-slate-500 mt-2">

                Informasi lengkap customer.

            </p>

        </div>

        <a href="{{ route('customers.index') }}"
            class="px-5 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

            <i class="fa-solid fa-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>

    <!-- Card -->

    <div class="bg-white rounded-3xl shadow-md overflow-hidden">

        <!-- Header Card -->

        <div class="bg-gradient-to-r from-blue-600 to-blue-500 p-8 text-white">

            <div class="flex items-center gap-6">

                <div class="w-24 h-24 rounded-full bg-white/20 flex items-center justify-center">

                    <i class="fa-solid fa-user text-5xl"></i>

                </div>

                <div>

                    <h2 class="text-3xl font-bold">

                        {{ $customer->nama_customer }}

                    </h2>

                    <p class="mt-2 text-blue-100">

                        {{ $customer->kode_customer }}

                    </p>

                </div>

            </div>

        </div>

        <!-- Detail -->

        <div class="p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Kode -->

                <div>

                    <p class="text-gray-500 text-sm">

                        Kode Customer

                    </p>

                    <h3 class="font-semibold text-lg mt-2">

                        {{ $customer->kode_customer }}

                    </h3>

                </div>

                <!-- Nama -->

                <div>

                    <p class="text-gray-500 text-sm">

                        Nama Customer

                    </p>

                    <h3 class="font-semibold text-lg mt-2">

                        {{ $customer->nama_customer }}

                    </h3>

                </div>

                <!-- Telepon -->

                <div>

                    <p class="text-gray-500 text-sm">

                        Nomor Telepon

                    </p>

                    <h3 class="font-semibold text-lg mt-2">

                        {{ $customer->telepon }}

                    </h3>

                </div>

                <!-- Email -->

                <div>

                    <p class="text-gray-500 text-sm">

                        Email

                    </p>

                    <h3 class="font-semibold text-lg mt-2">

                        {{ $customer->email ?: '-' }}

                    </h3>

                </div>

                <!-- Alamat -->

                <div class="md:col-span-2">

                    <p class="text-gray-500 text-sm">

                        Alamat

                    </p>

                    <div class="mt-2 rounded-xl bg-gray-50 p-5 border">

                        {{ $customer->alamat ?: '-' }}

                    </div>

                </div>

            </div>

        </div>

        <!-- Footer -->

        <div class="bg-gray-50 px-8 py-5 flex justify-end gap-3">

            <a href="{{ route('customers.edit',$customer->id) }}"
                class="px-6 py-3 rounded-xl bg-yellow-500 text-white hover:bg-yellow-600">

                <i class="fa-solid fa-pen mr-2"></i>

                Edit

            </a>

            <a href="{{ route('customers.index') }}"
                class="px-6 py-3 rounded-xl bg-gray-300 hover:bg-gray-400">

                Tutup

            </a>

        </div>

    </div>

</div>

@endsection