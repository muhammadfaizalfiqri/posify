@extends('layouts.app')

@section('content')

<div class="space-y-8">

    <!-- ================= HEADER ================= -->

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-slate-800">

                Produk

            </h1>

            <p class="text-slate-500 mt-2">

                Kelola seluruh produk toko Anda

            </p>

        </div>

        <div class="flex gap-4">

            <button
                class="px-5 py-3 rounded-xl bg-white border border-slate-200 shadow hover:bg-slate-50 duration-300">

                <i class="fa-solid fa-file-export mr-2"></i>

                Export

            </button>

            <button
                class="px-6 py-3 rounded-xl bg-blue-600 text-white shadow-lg hover:bg-blue-700 duration-300">

                <i class="fa-solid fa-plus mr-2"></i>

                Tambah Produk

            </button>

        </div>

    </div>



    <!-- ================= CARD ================= -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Total Produk -->

        <div
            class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Total Produk

                    </p>

                    <h2 class="text-4xl font-bold mt-3">

                        125

                    </h2>

                </div>

                <div
                    class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i
                        class="fa-solid fa-box text-3xl text-blue-600">

                    </i>

                </div>

            </div>

        </div>



        <!-- Stok Menipis -->

        <div
            class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Stok Menipis

                    </p>

                    <h2 class="text-4xl font-bold mt-3">

                        8

                    </h2>

                </div>

                <div
                    class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">

                    <i
                        class="fa-solid fa-triangle-exclamation text-3xl text-red-600">

                    </i>

                </div>

            </div>

        </div>



        <!-- Kategori -->

        <div
            class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Kategori

                    </p>

                    <h2 class="text-4xl font-bold mt-3">

                        12

                    </h2>

                </div>

                <div
                    class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center">

                    <i
                        class="fa-solid fa-tags text-3xl text-orange-600">

                    </i>

                </div>

            </div>

        </div>



        <!-- Supplier -->

        <div
            class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Supplier

                    </p>

                    <h2 class="text-4xl font-bold mt-3">

                        15

                    </h2>

                </div>

                <div
                    class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i
                        class="fa-solid fa-truck text-3xl text-green-600">

                    </i>

                </div>

            </div>

        </div>

    </div>



    <!-- ================= SEARCH ================= -->

    <div
        class="bg-white rounded-3xl shadow-md p-6">

        <div
            class="grid grid-cols-1 lg:grid-cols-4 gap-5">

            <!-- Search -->

            <div class="lg:col-span-2">

                <div class="relative">

                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-slate-400">

                    </i>

                    <input
                        type="text"
                        placeholder="Cari produk..."
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

            </div>



            <!-- Filter -->

            <select
                class="rounded-xl border border-slate-200 px-4">

                <option>

                    Semua Kategori

                </option>

                <option>

                    Minuman

                </option>

                <option>

                    Makanan

                </option>

            </select>



            <select
                class="rounded-xl border border-slate-200 px-4">

                <option>

                    Semua Status

                </option>

                <option>

                    Aktif

                </option>

                <option>

                    Tidak Aktif

                </option>

            </select>

        </div>

    </div>



    <!-- ================= TABEL ================= -->

    <div
        class="bg-white rounded-3xl shadow-md overflow-hidden">

        <div
            class="overflow-x-auto">

            <table
                class="w-full">

                <thead
                    class="bg-slate-100">

                    <tr>

                        <th class="text-left py-5 px-6">

                            Foto

                        </th>

                        <th class="text-left py-5">

                            Nama Produk

                        </th>

                        <th class="text-left py-5">

                            Kategori

                        </th>

                        <th class="text-left py-5">

                            Harga

                        </th>

                        <th class="text-left py-5">

                            Stok

                        </th>

                        <th class="text-left py-5">

                            Status

                        </th>

                        <th class="text-center py-5">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>
                                    <!-- ================= DATA PRODUK ================= -->

                @for($i = 1; $i <= 8; $i++)

                <tr
                class="border-b border-slate-100 hover:bg-slate-50 duration-200">

                    <td class="px-6 py-5">

                        <img
                        src="https://placehold.co/60x60"
                        class="w-14 h-14 rounded-xl object-cover">

                    </td>

                    <td>

                        <div>

                            <h3
                            class="font-semibold text-slate-700">

                                Aqua 600ml

                            </h3>

                            <span
                            class="text-sm text-slate-400">

                                PRD00{{ $i }}

                            </span>

                        </div>

                    </td>

                    <td>

                        <span
                        class="px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm">

                            Minuman

                        </span>

                    </td>

                    <td>

                        <span
                        class="font-semibold">

                            Rp5.000

                        </span>

                    </td>

                    <td>

                        <span
                        class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm">

                            120

                        </span>

                    </td>

                    <td>

                        <span
                        class="px-4 py-2 rounded-full bg-emerald-100 text-emerald-700 text-sm">

                            Aktif

                        </span>

                    </td>

                    <td>

                        <div
                        class="flex justify-center gap-3">

                            <!-- Detail -->

                            <button
                            class="w-10 h-10 rounded-xl
                            bg-slate-100
                            hover:bg-slate-200
                            duration-300">

                                <i
                                class="fa-solid fa-eye text-slate-600">

                                </i>

                            </button>

                            <!-- Edit -->

                            <button
                            class="w-10 h-10 rounded-xl
                            bg-yellow-100
                            hover:bg-yellow-200
                            duration-300">

                                <i
                                class="fa-solid fa-pen text-yellow-700">

                                </i>

                            </button>

                            <!-- Delete -->

                            <button
                            class="w-10 h-10 rounded-xl
                            bg-red-100
                            hover:bg-red-200
                            duration-300">

                                <i
                                class="fa-solid fa-trash text-red-700">

                                </i>

                            </button>

                        </div>

                    </td>

                </tr>

                @endfor

                </tbody>

            </table>

        </div>

    </div>

    <!-- ================= PAGINATION ================= -->

    <div
    class="flex justify-between items-center">

        <div
        class="text-slate-500">

            Menampilkan

            <span class="font-semibold">

                1-8

            </span>

            dari

            <span class="font-semibold">

                125

            </span>

            produk

        </div>

        <div
        class="flex gap-2">

            <button
            class="px-4 py-2 rounded-xl border border-slate-300 hover:bg-slate-100">

                <i class="fa-solid fa-chevron-left"></i>

            </button>

            <button
            class="px-4 py-2 rounded-xl bg-blue-600 text-white">

                1

            </button>

            <button
            class="px-4 py-2 rounded-xl border border-slate-300 hover:bg-slate-100">

                2

            </button>

            <button
            class="px-4 py-2 rounded-xl border border-slate-300 hover:bg-slate-100">

                3

            </button>

            <button
            class="px-4 py-2 rounded-xl border border-slate-300 hover:bg-slate-100">

                <i class="fa-solid fa-chevron-right"></i>

            </button>

        </div>

    </div>

</div>

@endsection
