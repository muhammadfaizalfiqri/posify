@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')

<div class="p-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Supplier
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola data supplier
            </p>

        </div>

        <div class="flex gap-3">

        <a href="{{ route('suppliers.export') }}"
            class="px-5 py-3 rounded-xl bg-green-600 text-white hover:bg-green-700">

            <i class="fa-solid fa-file-csv mr-2"></i>
            Export CSV

        </a>

        <a href="{{ route('suppliers.create') }}"
            class="px-5 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

            <i class="fa-solid fa-plus mr-2"></i>
            Tambah Supplier

        </a>

        </div>

    </div>

   <!-- ================= CARD ================= -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    <!-- Total Supplier -->
    <div class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">
        <div class="flex justify-between">
            <div>
                <p class="text-slate-500">Total Supplier</p>
                <h2 class="text-4xl font-bold mt-3">
                    {{ $totalSupplier }}
                </h2>
            </div>

            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">
                <i class="fa-solid fa-truck text-3xl text-blue-600"></i>
            </div>
        </div>
    </div>

    <!-- Supplier Aktif -->
    <div class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">
        <div class="flex justify-between">
            <div>
                <p class="text-slate-500">Supplier Aktif</p>
                <h2 class="text-4xl font-bold mt-3">
                    {{ $supplierAktif }}
                </h2>
            </div>

            <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">
                <i class="fa-solid fa-circle-check text-3xl text-green-600"></i>
            </div>
        </div>
    </div>

    <!-- Supplier Nonaktif -->
    <div class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">
        <div class="flex justify-between">
            <div>
                <p class="text-slate-500">Supplier Nonaktif</p>
                <h2 class="text-4xl font-bold mt-3">
                    {{ $supplierNonaktif }}
                </h2>
            </div>

            <div class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">
                <i class="fa-solid fa-circle-xmark text-3xl text-red-600"></i>
            </div>
        </div>
    </div>

    <!-- Supplier Terbaru -->
    <div class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">
        <div class="flex justify-between">
            <div>
                <p class="text-slate-500">Supplier Terbaru</p>

                <h2 class="text-xl font-bold mt-3">
                    {{ $supplierTerbaru?->nama_supplier ?? '-' }}
                </h2>

                <p class="text-gray-500 mt-2">
                    {{ $supplierTerbaru?->kode_supplier ?? '-' }}
                </p>
            </div>

            <div class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center">
                <i class="fa-solid fa-star text-3xl text-orange-600"></i>
            </div>
        </div>
    </div>

</div>

<!-- ================= SEARCH ================= -->

<div class="bg-white rounded-3xl shadow-md p-6 mb-8">

    <form action="{{ route('suppliers.index') }}" method="GET">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

            <!-- Search -->
            <div class="lg:col-span-3">

                <div class="relative">

                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari supplier..."
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200">

                </div>

            </div>

            <!-- Status -->
            <select
                name="status"
                class="rounded-xl border border-slate-200 px-4">

                <option value="">Semua Status</option>

                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                    Tidak Aktif
                </option>

            </select>

        </div>

        <div class="flex justify-end gap-3 mt-5">

            <a href="{{ route('suppliers.index') }}"
                class="px-5 py-2 border rounded-xl">

                Reset

            </a>

            <button
                type="submit"
                class="px-5 py-2 bg-blue-600 text-white rounded-xl">

                Cari

            </button>

        </div>

    </form>

</div>

<!-- tabel -->

<div class="bg-white rounded-3xl shadow-md overflow-hidden">

<div class="overflow-x-auto">

<table class="w-full">

<thead>

<tr class="border-b text-gray-500 text-sm">

    <th class="py-4 px-6 text-left">Kode</th>

    <th class="py-4 px-6 text-left">Nama Supplier</th>

    <th class="py-4 px-6 text-left">Kontak</th>

    <th class="py-4 px-6 text-left">Email</th>

    <th class="py-4 px-6 text-center">Status</th>

    <th class="py-4 px-6 text-center">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($suppliers as $supplier)

<tr class="border-b hover:bg-gray-50">

    <td class="py-4 px-6">
        {{ $supplier->kode_supplier }}
    </td>

    <td class="py-4 px-6">
        {{ $supplier->nama_supplier }}
    </td>

    <td class="py-4 px-6">
        {{ $supplier->kontak }}
    </td>

    <td class="py-4 px-6">
        {{ $supplier->email }}
    </td>

    <td class="text-center">

        @if($supplier->status)

            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                Aktif
            </span>

        @else

            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">
                Tidak Aktif
            </span>

        @endif

    </td>

    <td>

        <div class="flex justify-center gap-2">

            <a
                href="{{ route('suppliers.show',$supplier->id) }}"
                class="w-9 h-9 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">

                <i class="fa-solid fa-eye"></i>

            </a>

            <a
                href="{{ route('suppliers.edit',$supplier->id) }}"
                class="w-9 h-9 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center">

                <i class="fa-solid fa-pen"></i>

            </a>

            <form
                action="{{ route('suppliers.destroy',$supplier->id) }}"
                method="POST"
                class="delete-form">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="w-9 h-9 rounded-lg bg-red-100 text-red-600
                        flex items-center justify-center
                        hover:bg-red-500 hover:text-white">

                    <i class="fa-solid fa-trash"></i>

                </button>


            </form>

        </div>

    </td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center py-8 text-gray-400">

Belum ada data supplier.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<!-- Pagination -->

<div class="mt-6">

    {{ $suppliers->links() }}

</div>

</div>

@endsection