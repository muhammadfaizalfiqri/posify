@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<div class="space-y-8">

    <!-- ===================== HEADER ===================== -->

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-slate-800">

                Dashboard

            </h1>

            <p class="text-slate-500 mt-2">

                Selamat datang kembali di POSify.

            </p>

        </div>

        <div>

            <button
            class="bg-blue-600
            hover:bg-blue-700
            duration-300
            text-white
            px-6
            py-3
            rounded-xl
            shadow-lg">

                <i class="fa-solid fa-plus mr-2"></i>

                Transaksi Baru

            </button>

        </div>

    </div>

    <!-- ===================== CARD STATISTIK ===================== -->

    <div
    class="grid
    grid-cols-1
    md:grid-cols-2
    xl:grid-cols-4
    gap-6">

        <!-- Card 1 -->

        <div
        class="bg-white
        rounded-3xl
        shadow-md
        hover:shadow-xl
        duration-300
        p-7">

            <div class="flex justify-between">

                <div>

                    <span
                    class="text-slate-500">

                        Total Penjualan

                    </span>

                    <h2
                    class="text-3xl
                    font-bold
                    mt-3">

                        Rp {{ number_format($stats['sales'],0,',','.') }}

                    </h2>

                    <p
                    class="text-green-600
                    mt-4
                    text-sm">

                        <i class="fa-solid fa-arrow-trend-up"></i>

                        Naik 12%

                    </p>

                </div>

                <div
                class="w-16
                h-16
                rounded-2xl
                bg-green-100
                flex
                justify-center
                items-center">

                    <i
                    class="fa-solid fa-sack-dollar
                    text-3xl
                    text-green-600">

                    </i>

                </div>

            </div>

        </div>

        <!-- Card 2 -->

        <div
        class="bg-white
        rounded-3xl
        shadow-md
        hover:shadow-xl
        duration-300
        p-7">

            <div class="flex justify-between">

                <div>

                    <span
                    class="text-slate-500">

                        Total Produk

                    </span>

                    <h2
                    class="text-3xl
                    font-bold
                    mt-3">

                        {{ $stats['products'] }}

                    </h2>

                    <p
                    class="text-blue-600
                    mt-4
                    text-sm">

                        Produk Aktif

                    </p>

                </div>

                <div
                class="w-16
                h-16
                rounded-2xl
                bg-blue-100
                flex
                justify-center
                items-center">

                    <i
                    class="fa-solid fa-box
                    text-3xl
                    text-blue-600">

                    </i>

                </div>

            </div>

        </div>

        <!-- Card 3 -->

        <div
        class="bg-white
        rounded-3xl
        shadow-md
        hover:shadow-xl
        duration-300
        p-7">

            <div class="flex justify-between">

                <div>

                    <span
                    class="text-slate-500">

                        Customer

                    </span>

                    <h2
                    class="text-3xl
                    font-bold
                    mt-3">

                        {{ $stats['customers'] }}

                    </h2>

                    <p
                    class="text-orange-500
                    mt-4
                    text-sm">

                        Customer Aktif

                    </p>

                </div>

                <div
                class="w-16
                h-16
                rounded-2xl
                bg-orange-100
                flex
                justify-center
                items-center">

                    <i
                    class="fa-solid fa-users
                    text-3xl
                    text-orange-600">

                    </i>

                </div>

            </div>

        </div>

        <!-- Card 4 -->

        <div
        class="bg-white
        rounded-3xl
        shadow-md
        hover:shadow-xl
        duration-300
        p-7">

            <div class="flex justify-between">

                <div>

                    <span
                    class="text-slate-500">

                        Transaksi

                    </span>

                    <h2
                    class="text-3xl
                    font-bold
                    mt-3">

                        {{ $stats['transactions'] }}

                    </h2>

                    <p
                    class="text-purple-500
                    mt-4
                    text-sm">

                        Hari Ini

                    </p>

                </div>

                <div
                class="w-16
                h-16
                rounded-2xl
                bg-purple-100
                flex
                justify-center
                items-center">

                    <i
                    class="fa-solid fa-cart-shopping
                    text-3xl
                    text-purple-600">

                    </i>

                </div>

            </div>

        </div>

    </div>

    <!-- ===================== GRAFIK + AKTIVITAS ===================== -->

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

    <div
    class="xl:col-span-2
    bg-white
    rounded-3xl
    shadow-md
    p-8">

    <div
    class="flex
    justify-between"    
    items-center
    mb-8">

        <div>

            <h2 class="text-2xl font-bold">
                Grafik Penjualan
            </h2>

            <p class="text-slate-500">
                Penjualan 7 Hari Terakhir
            </p>

        </div>

        <button
        class="border
        border-blue-500
        text-blue-600
        px-4
        py-2
        rounded-xl">

            Mingguan

        </button>

    </div>

    <div class="h-80">
        <canvas id="salesChart"></canvas>
    </div>

</div>

        <!-- ===================== AKTIVITAS ===================== -->

<div
class="bg-white
rounded-3xl
shadow-md
p-8">

    <h2
    class="text-2xl
    font-bold
    mb-8">

        Aktivitas Terbaru

    </h2>

    <div class="space-y-6">

        @foreach($activities as $activity)

        <div
        class="flex
        items-start
        gap-4">

            <div
            class="w-12
            h-12
            rounded-xl
            bg-slate-100
            flex
            justify-center
            items-center">

                <i
                class="fa-solid {{ $activity['icon'] }}
                {{ $activity['class'] }}
                text-lg">

                </i>

            </div>

            <div>

                <h4
                class="font-semibold
                text-slate-700">

                    {{ $activity['title'] }}

                </h4>

                <span
                class="text-sm
                text-slate-500">

                    {{ $activity['time'] }}

                </span>

            </div>

        </div>

        @endforeach

    </div>

</div>

</div>

</div>

<!-- ===================== TABEL TRANSAKSI ===================== -->

<div class="bg-white rounded-3xl shadow-md p-8 mt-8">

<div
class="bg-white
rounded-3xl
shadow-md
p-8">

    <div
    class="flex
    justify-between
    items-center
    mb-8">

        <div>

            <h2
            class="text-2xl
            font-bold">

                Transaksi Terbaru

            </h2>

            <p
            class="text-slate-500">

                Daftar transaksi hari ini

            </p>

        </div>

        <button
        class="px-5
        py-2
        rounded-xl
        bg-blue-600
        text-white
        hover:bg-blue-700
        duration-300">

            Lihat Semua

        </button>

    </div>

    <div class="overflow-x-auto">

        <table
        class="w-full">

            <thead>

                <tr
                class="border-b">

                    <th class="text-left py-4">

                        Invoice

                    </th>

                    <th class="text-left py-4">

                        Customer

                    </th>

                    <th class="text-left py-4">

                        Kasir

                    </th>

                    <th class="text-left py-4">

                        Total

                    </th>

                    <th class="text-left py-4">

                        Status

                    </th>

                </tr>

            </thead>

            <tbody>

                <tr
                class="border-b
                hover:bg-slate-50">

                    <td class="py-5">

                        INV001

                    </td>

                    <td>

                        Andi

                    </td>

                    <td>

                        Faiz

                    </td>

                    <td>

                        Rp250.000

                    </td>

                    <td>

                        <span
                        class="bg-green-100
                        text-green-700
                        px-4
                        py-2
                        rounded-full
                        text-sm">

                            Berhasil

                        </span>

                    </td>

                </tr>

                <tr
                class="border-b
                hover:bg-slate-50">

                    <td class="py-5">

                        INV002

                    </td>

                    <td>

                        Rina

                    </td>

                    <td>

                        Faiz

                    </td>

                    <td>

                        Rp135.000

                    </td>

                    <td>

                        <span
                        class="bg-yellow-100
                        text-yellow-700
                        px-4
                        py-2
                        rounded-full
                        text-sm">

                            Pending

                        </span>

                    </td>

                </tr>

                <tr
                class="border-b
                hover:bg-slate-50">

                    <td class="py-5">

                        INV003

                    </td>

                    <td>

                        Budi

                    </td>

                    <td>

                        Faiz

                    </td>

                    <td>

                        Rp420.000

                    </td>

                    <td>

                        <span
                        class="bg-green-100
                        text-green-700
                        px-4
                        py-2
                        rounded-full
                        text-sm">

                            Berhasil

                        </span>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

</div>

</div>

@endsection