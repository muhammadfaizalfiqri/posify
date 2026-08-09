@extends('layouts.app')

@section('title','Laporan')

@section('content')

<div class="space-y-6">

    <div>

        <h1 class="text-3xl font-bold text-slate-800">
            Laporan Penjualan
        </h1>

        <p class="text-slate-500 mt-1">
            Riwayat seluruh transaksi penjualan.
        </p>

    </div>

    <form method="GET">

    <div class="grid md:grid-cols-5 gap-4">

        <div>
            <label class="text-sm font-medium">Dari</label>

            <input
                type="date"
                name="start_date"
                value="{{ request('start_date') }}"
                class="w-full mt-2 border rounded-xl p-3">
        </div>

        <div>
            <label class="text-sm font-medium">Sampai</label>

            <input
                type="date"
                name="end_date"
                value="{{ request('end_date') }}"
                class="w-full mt-2 border rounded-xl p-3">
        </div>

        <div class="flex items-end">

            <button
                class="bg-blue-600 text-white px-6 py-3 rounded-xl w-full">

                Filter

            </button>

        </div>

        <div class="flex items-end">

            <a
                href="{{ route('reports.index') }}"
                class="border px-6 py-3 rounded-xl w-full text-center">

                Reset

            </a>

        </div>

        <div class="flex items-end">

            <a
                href="{{ route('reports.export', request()->query()) }}"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl w-full text-center">

                <i class="fa-solid fa-file-csv mr-2"></i>

                Export CSV

            </a>

        </div>

    </div>

</form>

    <div class="bg-white rounded-3xl shadow-md overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">
                        Invoice
                    </th>

                    <th class="px-6 py-4 text-left">
                        Customer
                    </th>

                    <th class="px-6 py-4 text-right">
                        Total
                    </th>

                    <th class="px-6 py-4 text-center">
                        Tanggal
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($transactions as $trx)

                <tr class="border-b hover:bg-slate-50">

                    <td class="px-6 py-4">

                        <a
                            href="{{ route('reports.show', $trx->id) }}"
                            class="text-blue-600 hover:underline font-semibold">

                            {{ $trx->invoice }}

                        </a>

                    </td>

                    <td>

                        {{ $trx->customer->nama_customer ?? '-' }}

                    </td>

                    <td class="text-right">

                        Rp {{ number_format($trx->total,0,',','.') }}

                    </td>

                    <td class="text-center">

                        {{ $trx->created_at->format('d M Y') }}

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="py-12 text-center text-gray-400">

                        Belum ada transaksi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div>

        {{ $transactions->links() }}

    </div>

</div>

@endsection