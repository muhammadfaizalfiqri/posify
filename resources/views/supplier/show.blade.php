@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- Header -->

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Detail Supplier

            </h1>

            <p class="text-slate-500 mt-1">

                Informasi lengkap supplier.

            </p>

        </div>

        <a href="{{ route('suppliers.index') }}"
        class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">

            <i class="fa-solid fa-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>

    <!-- Card -->

    <div class="bg-white rounded-3xl shadow-md p-8">

        <div class="grid md:grid-cols-2 gap-8">

            <div>

                <p class="text-gray-500 mb-2">
                    Kode Supplier
                </p>

                <h3 class="text-xl font-semibold">

                    {{ $supplier->kode_supplier }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500 mb-2">
                    Nama Supplier
                </p>

                <h3 class="text-xl font-semibold">

                    {{ $supplier->nama_supplier }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500 mb-2">
                    Nomor Telepon
                </p>

                <h3 class="text-xl font-semibold">

                    {{ $supplier->kontak }}

                </h3>

            </div>

            <div>

                <p class="text-gray-500 mb-2">
                    Email
                </p>

                <h3 class="text-xl font-semibold">

                    {{ $supplier->email }}

                </h3>

            </div>

        </div>

        <div class="mt-8">

            <p class="text-gray-500 mb-2">

                Alamat

            </p>

            <div class="bg-slate-50 rounded-xl p-4">

                {{ $supplier->alamat }}

            </div>

        </div>

        <div class="mt-8">

            <p class="text-gray-500 mb-2">

                Status

            </p>

            @if($supplier->status)

                <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                    Aktif

                </span>

            @else

                <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold">

                    Tidak Aktif

                </span>

            @endif

        </div>

    </div>

</div>

@endsection