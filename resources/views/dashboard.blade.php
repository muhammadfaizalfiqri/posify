@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<div class="space-y-8">

    <!-- ================= HEADER ================= -->

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-4xl font-bold text-slate-800">

                Dashboard

            </h1>

            <p class="text-slate-500 mt-2">

                Selamat datang kembali di POSify.

            </p>

        </div>

        <a
            href="{{ route('transactions.index') }}"
            class="bg-blue-600 hover:bg-blue-700 duration-300 text-white px-6 py-3 rounded-xl shadow-lg">

            <i class="fa-solid fa-plus mr-2"></i>

            Transaksi Baru

        </a>

    </div>

    <!-- ================= CARD STATISTIK ================= -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Total Penjualan -->

        <div class="bg-white rounded-3xl shadow-md hover:shadow-xl duration-300 p-7">

            <div class="flex justify-between">

                <div>

                    <span class="text-slate-500">

                        Total Penjualan

                    </span>

                    <h2 class="text-3xl font-bold mt-3">

                        Rp {{ number_format($stats['sales'],0,',','.') }}

                    </h2>

                    <p class="text-green-600 mt-4 text-sm">

                        Akumulasi seluruh transaksi

                    </p>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-green-100 flex justify-center items-center">

                    <i class="fa-solid fa-sack-dollar text-3xl text-green-600"></i>

                </div>

            </div>

        </div>

        <!-- Total Produk -->

        <div class="bg-white rounded-3xl shadow-md hover:shadow-xl duration-300 p-7">

            <div class="flex justify-between">

                <div>

                    <span class="text-slate-500">

                        Total Produk

                    </span>

                    <h2 class="text-3xl font-bold mt-3">

                        {{ $jumlahProduk }}

                    </h2>

                    <p class="text-blue-600 mt-4 text-sm">

                        Produk tersedia

                    </p>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-blue-100 flex justify-center items-center">

                    <i class="fa-solid fa-box text-3xl text-blue-600"></i>

                </div>

            </div>

        </div>

        <!-- Total Customer -->

        <div class="bg-white rounded-3xl shadow-md hover:shadow-xl duration-300 p-7">

            <div class="flex justify-between">

                <div>

                    <span class="text-slate-500">

                        Customer

                    </span>

                    <h2 class="text-3xl font-bold mt-3">

                        {{ $jumlahCustomer }}

                    </h2>

                    <p class="text-orange-500 mt-4 text-sm">

                        Customer terdaftar

                    </p>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-orange-100 flex justify-center items-center">

                    <i class="fa-solid fa-users text-3xl text-orange-600"></i>

                </div>

            </div>

        </div>

        <!-- Total Transaksi -->

        <div class="bg-white rounded-3xl shadow-md hover:shadow-xl duration-300 p-7">

            <div class="flex justify-between">

                <div>

                    <span class="text-slate-500">

                        Total Transaksi

                    </span>

                    <h2 class="text-3xl font-bold mt-3">

                        {{ $stats['transactions'] }}

                    </h2>

                    <p class="text-purple-500 mt-4 text-sm">

                        Seluruh transaksi

                    </p>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-purple-100 flex justify-center items-center">

                    <i class="fa-solid fa-cart-shopping text-3xl text-purple-600"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- ===================== GRAFIK + AKTIVITAS ===================== -->

<div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

    <!-- ================= GRAFIK ================= -->

    <div class="xl:col-span-2 bg-white rounded-3xl shadow-md p-8">

        <div class="flex justify-between items-center mb-8">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">

                    Grafik Penjualan

                </h2>

                <p class="text-slate-500 mt-1">

                    Total penjualan 7 hari terakhir

                </p>

            </div>

            <div class="bg-blue-50 text-blue-600 px-4 py-2 rounded-xl text-sm font-medium">

                7 Hari Terakhir

            </div>

        </div>

        <div class="h-80">

            <canvas id="salesChart"></canvas>

        </div>

    </div>

    <!-- ================= AKTIVITAS ================= -->

    <div class="bg-white rounded-3xl shadow-md p-8">

        <div class="flex items-center justify-between mb-8">

            <h2 class="text-2xl font-bold text-slate-800">

                Aktivitas Terbaru

            </h2>

            <i class="fa-solid fa-clock-rotate-left text-slate-400"></i>

        </div>

        <div class="space-y-6">

            @forelse($activities as $activity)

                <div class="flex items-start gap-4">

                    <div class="w-12 h-12 rounded-xl bg-slate-100 flex justify-center items-center">

                        <i class="fa-solid {{ $activity['icon'] }} {{ $activity['class'] }} text-lg"></i>

                    </div>

                    <div class="flex-1">

                        <h4 class="font-semibold text-slate-700">

                            {{ $activity['title'] }}

                        </h4>

                        <p class="text-sm text-slate-500 mt-1">

                            {{ $activity['time'] }}

                        </p>

                    </div>

                </div>

            @empty

                <div class="text-center py-10">

                    <i class="fa-solid fa-clock text-4xl text-slate-300 mb-3"></i>

                    <p class="text-slate-400">

                        Belum ada aktivitas.

                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

<!-- ===================== TRANSAKSI TERBARU ===================== -->

<div class="bg-white rounded-3xl shadow-md p-8">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h2 class="text-2xl font-bold text-slate-800">

                Transaksi Terbaru

            </h2>

            <p class="text-slate-500 mt-1">

                5 transaksi terakhir

            </p>

        </div>

        <a
            href="{{ route('reports.index') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl duration-300">

            <i class="fa-solid fa-file-lines mr-2"></i>

            Lihat Semua

        </a>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">

                        Invoice

                    </th>

                    <th class="px-6 py-4 text-left">

                        Customer

                    </th>

                    <th class="px-6 py-4 text-left">

                        Kasir

                    </th>

                    <th class="px-6 py-4 text-right">

                        Total

                    </th>

                    <th class="px-6 py-4 text-center">

                        Status

                    </th>

                    <th class="px-6 py-4 text-center">

                        Tanggal

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($latestTransactions as $trx)

                <tr class="border-b hover:bg-slate-50 transition items-center">

                    <td class="px-6 py-5 font-semibold text-blue-600">

                        {{ $trx->invoice }}

                    </td>

                    <td class="px-6 py-5">

                        {{ $trx->customer?->nama_customer ?? 'Customer Umum' }}

                    </td>

                    <td class="px-6 py-5">

                        {{ auth()->user()->name }}

                    </td>

                    <td class="px-6 py-5 text-right font-semibold">

                        Rp {{ number_format($trx->total,0,',','.') }}

                    </td>

                    <td class="px-6 py-5 text-center">

                        <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-medium">

                            <i class="fa-solid fa-circle-check mr-2"></i>

                            Berhasil

                        </span>

                    </td>

                    <td class="px-6 py-5 text-center text-slate-500">

                        {{ $trx->created_at->format('d M Y') }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6" class="px-6 py-14 text-center text-slate-400">

                        <i class="fa-solid fa-receipt text-4xl mb-3 block"></i>

                        Belum ada transaksi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@push('scripts')

<script>

window.salesLabels = @json($labels);

window.salesData = @json($data);

</script>

@vite(['resources/js/dashboard.js', 'resources/js/transaction/index.js'])

@endpush

@endsection