@extends('layouts.app')

@section('content')

<div class="p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Supplier
            </h1>

            <p class="text-slate-500 mt-1">
                Perbarui data supplier.
            </p>

        </div>

        <a href="{{ route('suppliers.index') }}"
            class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100 duration-300">

            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali

        </a>

    </div>

    <!-- Card -->
    <div class="bg-white rounded-3xl shadow-md p-8">

        <form action="{{ route('suppliers.update',$supplier->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Kode Supplier -->
                <div>

                    <label class="font-semibold text-slate-600">
                        Kode Supplier
                    </label>

                    <input
                        type="text"
                        name="kode_supplier"
                        value="{{ old('kode_supplier',$supplier->kode_supplier) }}"
                        class="w-full mt-2 rounded-xl border border-slate-300 bg-slate-100 px-4 py-3">

                    @error('kode_supplier')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Nama Supplier -->
                <div>

                    <label class="font-semibold text-slate-600">
                        Nama Supplier
                    </label>

                    <input
                        type="text"
                        name="nama_supplier"
                        value="{{ old('nama_supplier',$supplier->nama_supplier) }}"
                        class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">

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
                        value="{{ old('kontak',$supplier->kontak) }}"
                        class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">

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
                        value="{{ old('email',$supplier->email) }}"
                        class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">

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
                    class="w-full mt-2 rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-yellow-500 outline-none">{{ old('alamat',$supplier->alamat) }}</textarea>

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

                    <option value="1"
                        {{ old('status',$supplier->status)==1 ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0"
                        {{ old('status',$supplier->status)==0 ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>

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
                    class="px-6 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white">

                    <i class="fa-solid fa-pen mr-2"></i>

                    Update Supplier

                </button>

            </div>

        </form>

    </div>

</div>

@endsection