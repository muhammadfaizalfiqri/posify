@extends('layouts.app')

@section('title', 'Data Product')

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

            <a href="{{ route('products.export', request()->query()) }}"
                class="px-5 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 flex items-center gap-2">

                <i class="fa-solid fa-file-csv"></i>

                Export CSV

            </a>

            <a href="{{ route('products.create') }}"
                class="px-6 py-3 rounded-xl bg-blue-600 text-white shadow-lg hover:bg-blue-700 duration-300">

                <i class="fa-solid fa-plus mr-2"></i>

                Tambah Produk

            </a>

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

                        {{ $totalProduk }}

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
            onclick="window.location='{{ route('products.index', ['filter' => 'stok-menipis']) }}'"
            class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl hover:scale-105 duration-300 cursor-pointer">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">
                        Stok Menipis
                    </p>

                    <h2 class="text-4xl font-bold mt-3">
                        {{ $stokMenipis }}
                    </h2>

                    <p class="text-sm text-red-500 mt-2">
                        Klik untuk melihat produk
                    </p>

                </div>

                <div
                    class="w-16 h-16 rounded-2xl bg-red-100 flex items-center justify-center">

                    <i class="fa-solid fa-triangle-exclamation text-3xl text-red-600"></i>

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

                        {{ $jumlahkategori }}

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

                        {{ $jumlahSupplier }}

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
    <div class="bg-white rounded-3xl shadow-md p-6">

        <form action="{{ route('products.index') }}" method="GET">

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-5">

                <!-- Search -->
                <div class="lg:col-span-2">
                    <div class="relative">

                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-slate-400"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari produk..."
                            class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">

                    </div>
                </div>

                <!-- Filter Kategori -->
                <select
                    name="category_id"
                    class="rounded-xl border border-slate-200 px-4">

                    <option value="">Semua Kategori</option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>

                            {{ $category->kode_kategori }} - {{ $category->nama_kategori }}

                        </option>

                    @endforeach

                </select>

                <!-- Filter Status -->
                <select
                    name="status"
                    class="rounded-xl border border-slate-200 px-4">

                    <option value="">Semua Status</option>

                    <option value="1"
                        {{ request('status') == '1' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0"
                        {{ request('status') == '0' ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>

                </select>

            </div>

            <div class="flex justify-end mt-5 gap-3">

                <a href="{{ route('products.index') }}"
                    class="px-5 py-2 rounded-xl border hover:bg-gray-100">

                    Reset

                </a>

                <button
                    class="px-5 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                    Cari

                </button>

            </div>

        </form>

    </div>



    <!-- ================= TABEL ================= -->

    <div
        class="bg-white rounded-3xl shadow-md overflow-hidden">

        <div
            class="overflow-x-auto">

           <table class="w-full">

            <thead>

                <tr class="border-b text-gray-500 text-sm">

                    <th class="py-4 px-6 text-left">Kode</th>

                    <th class="py-4 px-6 text-left">Nama Produk</th>

                    <th class="py-4 px-6 text-left">Kategori</th>

                    <th class="py-4 px-6 text-left">Harga</th>

                    <th class="py-4 px-6 text-center">Stok</th>

                    <th class="py-4 px-6 text-center">Status</th>

                    <th class="py-4 px-6 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($products as $product)

                <tr class="border-b hover:bg-gray-50 duration-200">

                    <td class="py-4 px-6 font-medium">
                        {{ $product->kode_produk }}
                    </td>

                    <td class="py-4 px-6">
                        {{ $product->nama_produk }}
                    </td>

                    <td class="py-4 px-6">
                        {{ $product->category->kode_kategori }} - {{ $product->category->nama_kategori }}
                    </td>

                    <td class="py-4 px-6">
                        Rp {{ number_format($product->harga,0,',','.') }}
                    </td>

                    <td class="py-4 px-6 text-center">
                        {{ $product->stok }}
                    </td>

                    <td class="py-4 px-6 text-center">

                        @if($product->status)

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                Aktif
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                                Tidak Aktif
                            </span>

                        @endif

                    </td>

                    <td class="py-4 px-6 text-center">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('products.show',$product->id) }}"
                                class="w-9 h-9 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-500 hover:text-white">

                                <i class="fa-solid fa-eye"></i>

                            </a>

                            <a href="{{ route('products.edit', $product->id) }}"
                                class="w-9 h-9 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center hover:bg-yellow-500 hover:text-white">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}"
                                method="POST"
                                class="inline-block delete-form">

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

                    <td colspan="7" class="text-center py-8 text-gray-400">

                        Belum ada data produk.

                    </td>

                </tr>

                @endforelse

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

                {{ $products->firstItem() }}

            </span>

            -

            <span class="font-semibold">

                {{ $products->lastItem() }}

            </span>

            dari

            <span class="font-semibold">

                {{ $products->total() }}

            </span>

            produk

        </div>

        <div>

            {{ $products->links() }}

        </div>

    </div>

</div>

@endsection