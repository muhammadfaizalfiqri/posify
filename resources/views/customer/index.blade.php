@extends('layouts.app')

@section('title', 'Data Customer')

@section('content')

<div class="space-y-8">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row justify-between items-center gap-5">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Data Customer

            </h1>

            <p class="text-slate-500 mt-2">

                Kelola seluruh data customer.

            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('customers.export') }}"
                class="px-6 py-3 bg-green-600 text-white rounded-xl hover:bg-green-700 duration-300">

                <i class="fa-solid fa-file-csv mr-2"></i>

                Export CSV

            </a>

            <a href="{{ route('customers.create') }}"
                class="px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 duration-300">

                <i class="fa-solid fa-plus mr-2"></i>

                Tambah Customer

            </a>

        </div>

    </div>

    <!-- CARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- Total Customer -->
        <div class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Total Customer

                    </p>

                    <h2 class="text-4xl font-bold mt-3">

                        {{ $totalCustomer }}

                    </h2>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center">

                    <i class="fa-solid fa-users text-3xl text-blue-600"></i>

                </div>

            </div>

        </div>

        <!-- Customer Terbaru -->
        <div class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Customer Terbaru

                    </p>

                    <h2 class="text-lg font-bold mt-3">

                        {{ $customerTerbaru?->nama_customer ?? '-' }}

                    </h2>

                    <p class="text-gray-500 mt-2">

                        {{ $customerTerbaru?->kode_customer ?? '-' }}

                    </p>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-orange-100 flex items-center justify-center">

                    <i class="fa-solid fa-user-plus text-3xl text-orange-600"></i>

                </div>

            </div>

        </div>

        <!-- Customer Bulan Ini -->
        <div class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Customer Bulan Ini

                    </p>

                    <h2 class="text-4xl font-bold mt-3">

                        {{ $customerBulanIni }}

                    </h2>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center">

                    <i class="fa-solid fa-calendar-days text-3xl text-green-600"></i>

                </div>

            </div>

        </div>

        <!-- Total Transaksi -->
        <div class="bg-white rounded-3xl shadow-md p-6 hover:shadow-xl duration-300">

            <div class="flex justify-between">

                <div>

                    <p class="text-slate-500">

                        Total Transaksi

                    </p>

                    <h2 class="text-4xl font-bold mt-3">

                        -

                    </h2>

                    <p class="text-gray-500 mt-2">

                        Coming Soon

                    </p>

                </div>

                <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center">

                    <i class="fa-solid fa-cart-shopping text-3xl text-purple-600"></i>

                </div>

            </div>

        </div>

    </div>

    <!-- SEARCH -->

    <div class="bg-white rounded-3xl shadow-md p-6">

        <form action="{{ route('customers.index') }}" method="GET">

            <div class="flex gap-4">

                <div class="relative flex-1">

                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-4 text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari customer..."
                        class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-blue-500 outline-none">

                </div>

                <button
                    type="submit"
                    class="px-6 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                    Cari

                </button>

            </div>

        </form>

    </div>

<!-- TABEL -->

<div class="bg-white rounded-3xl shadow-md overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead>

            <th class="py-4 px-6 text-left">Kode</th>

            <th class="py-4 px-6 text-left">Nama Customer</th>

            <th class="py-4 px-6 text-left">Telepon</th>

            <th class="py-4 px-6 text-left">Email</th>

            <th class="py-4 px-6 text-left">Alamat</th>

            <th class="py-4 px-6 text-center">Aksi</th>

            </tr>

            </thead>

            <tbody>

                @forelse($customers as $customer)

                <tr class="border-b hover:bg-gray-50 duration-200">

                    <td class="py-4 px-6 font-medium">

                        {{ $customer->kode_customer }}

                    </td>

                    <td class="py-4 px-6">

                        {{ $customer->nama_customer }}

                    </td>

                    <td class="py-4 px-6">

                        {{ $customer->telepon }}

                    </td>

                    <td class="py-4 px-6">

                        {{ $customer->email }}

                    </td>

                    <td class="py-4 px-6">

                        {{ $customer->alamat }}

                    </td>

                    <td class="py-4 px-6">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('customers.show',$customer->id) }}"
                                class="w-9 h-9 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-500 hover:text-white">

                                <i class="fa-solid fa-eye"></i>

                            </a>

                            <a href="{{ route('customers.edit',$customer->id) }}"
                                class="w-9 h-9 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center hover:bg-yellow-500 hover:text-white">

                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form
                                action="{{ route('customers.destroy',$customer->id) }}"
                                method="POST"
                                class="delete-form">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-9 h-9 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-500 hover:text-white">

                                    <i class="fa-solid fa-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-8 text-gray-400">

                        Belum ada data customer.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- PAGINATION -->

<div class="flex justify-between items-center">

    <div class="text-slate-500">

        Menampilkan

        <span class="font-semibold">

            {{ $customers->firstItem() ?? 0 }}

        </span>

        -

        <span class="font-semibold">

            {{ $customers->lastItem() ?? 0 }}

        </span>

        dari

        <span class="font-semibold">

            {{ $customers->total() }}

        </span>

        customer

    </div>

    {{ $customers->links() }}

</div>

</div>

@endsection