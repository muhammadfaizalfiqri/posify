@extends('layouts.app')

@section('title','Detail Transaksi')

@section('content')

<div class="space-y-6">

    <!-- Header -->

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Detail Transaksi
            </h1>

            <p class="text-slate-500 mt-1">
                Informasi lengkap transaksi penjualan.
            </p>

        </div>

        <div class="flex gap-3">

            <a
                href="{{ route('reports.index') }}"
                class="border border-gray-300 hover:bg-gray-100 px-6 py-3 rounded-xl transition">

                <i class="fa-solid fa-arrow-left mr-2"></i>

                Kembali

            </a>

            <a
                href="{{ route('reports.print',$transaction) }}"
                target="_blank"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl transition">

                <i class="fa-solid fa-print mr-2"></i>

                Cetak Invoice

            </a>

        </div>

    </div>

    <!-- Informasi Transaksi -->

    <div class="bg-white rounded-3xl shadow-md p-8">

        <div class="grid md:grid-cols-3 gap-6">

            <div>

                <label class="text-sm text-gray-500">
                    Invoice
                </label>

                <h2 class="text-xl font-bold mt-2">

                    {{ $transaction->invoice }}

                </h2>

            </div>

            <div>

                <label class="text-sm text-gray-500">
                    Customer
                </label>

                <h2 class="text-xl font-semibold mt-2">

                    {{ $transaction->customer->nama_customer ?? '-' }}

                </h2>

            </div>

            <div>

                <label class="text-sm text-gray-500">
                    Tanggal
                </label>

                <h2 class="text-xl font-semibold mt-2">

                    {{ $transaction->created_at->format('d M Y H:i') }}

                </h2>

            </div>

        </div>

    </div>

    <!-- Produk -->

    <div class="bg-white rounded-3xl shadow-md overflow-hidden">

        <div class="px-6 py-5 border-b">

            <h2 class="text-2xl font-bold text-slate-800">

                Daftar Produk

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Produk
                        </th>

                        <th class="px-6 py-4 text-center">
                            Qty
                        </th>

                        <th class="px-6 py-4 text-right">
                            Harga
                        </th>

                        <th class="px-6 py-4 text-right">
                            Subtotal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($transaction->details as $detail)

                    <tr class="border-b hover:bg-slate-50">

                        <td class="px-6 py-4">

                            {{ $detail->product->nama_produk }}

                        </td>

                        <td class="text-center">

                            {{ $detail->qty }}

                        </td>

                        <td class="text-right">

                            Rp {{ number_format($detail->harga,0,',','.') }}

                        </td>

                        <td class="text-right font-semibold">

                            Rp {{ number_format($detail->subtotal,0,',','.') }}

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    <!-- Ringkasan -->

    <div class="bg-white rounded-3xl shadow-md p-8">

        <h2 class="text-2xl font-bold text-slate-800 mb-8">

            Ringkasan Pembayaran

        </h2>

        <div class="space-y-5">

            <div class="flex justify-between">

                <span class="text-gray-500">

                    Subtotal

                </span>

                <strong>

                    Rp {{ number_format($transaction->subtotal,0,',','.') }}

                </strong>

            </div>

            <div class="flex justify-between">

                <span class="text-gray-500">

                    Diskon

                </span>

                <strong>

                    Rp {{ number_format($transaction->diskon,0,',','.') }}

                </strong>

            </div>

            <hr>

            <div class="flex justify-between items-center">

                <span class="text-xl font-bold">

                    Grand Total

                </span>

                <span class="text-3xl font-bold text-blue-600">

                    Rp {{ number_format($transaction->total,0,',','.') }}

                </span>

            </div>

            <div class="flex justify-between">

                <span class="text-gray-500">

                    Bayar

                </span>

                <strong>

                    Rp {{ number_format($transaction->bayar,0,',','.') }}

                </strong>

            </div>

            <div class="flex justify-between">

                <span class="text-gray-500">

                    Kembalian

                </span>

                <strong class="text-green-600 text-lg">

                    Rp {{ number_format($transaction->kembalian,0,',','.') }}

                </strong>

            </div>

        </div>

    </div>

</div>

@endsection