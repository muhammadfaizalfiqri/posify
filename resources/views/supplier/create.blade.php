@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Tambah Supplier
            </h1>

            <p class="text-slate-500 mt-1">
                Tambahkan data supplier baru.
            </p>

        </div>

        <a href="{{ route('suppliers.index') }}"
            class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100 duration-300">

            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali

        </a>

    </div>

    <!-- Card Form -->
    <div class="bg-white rounded-3xl shadow-md p-8">

        <form action="{{ route('suppliers.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Kode Supplier -->
                <div>

                    <label class="font-semibold text-slate-600">
                        Kode Supplier
                    </label>

                    <input
                        type="text"
                        name="kode_supplier"
                        value="{{ $kode_supplier }}"
                        readonly
                        class="w-full mt-2 rounded-xl border border-slate-300 bg-slate-100 px-4 py-3">

                </div>

                <!-- Nama Supplier -->
                <div>

                    <label class="font-semibold text-slate-600">
                        Nama Supplier
                    </label>

                    <input
                        type="text"
                        name="nama_supplier"
                        value="{{ old('nama_supplier') }}"
                        class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    @error('nama_supplier')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Nomor Telepon -->
                <div>

                    <label class="font-semibold text-slate-600">
                        Nomor Telepon
                    </label>

                    <input
                        type="text"
                        name="kontak"
                        value="{{ old('kontak') }}"
                        class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    @error('kontak')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Email -->
                <div>

                    <label class="font-semibold text-slate-600">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    @error('email')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror

                </div>

            </div>

            <!-- Alamat -->
            <div class="mt-6">

                <label class="font-semibold text-slate-600">
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    rows="4"
                    class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">{{ old('alamat') }}</textarea>

                @error('alamat')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror

            </div>

            <!-- Status -->
            <div class="mt-6">

                <label class="font-semibold text-slate-600">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3">

                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>

                </select>

            </div>

            <!-- Button -->
            <div class="flex justify-end gap-4 mt-8">

                <a href="{{ route('suppliers.index') }}"
                    class="px-6 py-3 rounded-xl border border-slate-300 hover:bg-slate-100">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white">

                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Simpan Supplier

                </button>

            </div>

        </form>

    </div>

</div>

@endsection