@extends('layouts.app')

@section('title','Tambah Customer')

@section('content')

<div class="max-w-4xl mx-auto">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Tambah Customer

            </h1>

            <p class="text-slate-500 mt-2">

                Tambahkan data customer baru.

            </p>

        </div>

        <a href="{{ route('customers.index') }}"
            class="px-5 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

            <i class="fa-solid fa-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>

    <!-- Form -->

    <div class="bg-white rounded-3xl shadow-md p-8">

        <form action="{{ route('customers.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Kode -->

                <div>

                    <label class="font-semibold">

                        Kode Customer

                    </label>

                    <input
                        type="text"
                        name="kode_customer"
                        value="{{ old('kode_customer') }}"
                        class="w-full mt-2 rounded-xl border border-gray-300 p-3">

                    @error('kode_customer')

                        <small class="text-red-500">{{ $message }}</small>

                    @enderror

                </div>

                <!-- Nama -->

                <div>

                    <label class="font-semibold">

                        Nama Customer

                    </label>

                    <input
                        type="text"
                        name="nama_customer"
                        value="{{ old('nama_customer') }}"
                        class="w-full mt-2 rounded-xl border border-gray-300 p-3">

                    @error('nama_customer')

                        <small class="text-red-500">{{ $message }}</small>

                    @enderror

                </div>

                <!-- Telepon -->

                <div>

                    <label class="font-semibold">

                        Telepon

                    </label>

                    <input
                        type="text"
                        name="telepon"
                        value="{{ old('telepon') }}"
                        class="w-full mt-2 rounded-xl border border-gray-300 p-3">

                    @error('telepon')

                        <small class="text-red-500">{{ $message }}</small>

                    @enderror

                </div>

                <!-- Email -->

                <div>

                    <label class="font-semibold">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full mt-2 rounded-xl border border-gray-300 p-3">

                    @error('email')

                        <small class="text-red-500">{{ $message }}</small>

                    @enderror

                </div>

                <!-- Alamat -->

                <div class="md:col-span-2">

                    <label class="font-semibold">

                        Alamat

                    </label>

                    <textarea
                        name="alamat"
                        rows="4"
                        class="w-full mt-2 rounded-xl border border-gray-300 p-3">{{ old('alamat') }}</textarea>

                    @error('alamat')

                        <small class="text-red-500">{{ $message }}</small>

                    @enderror

                </div>

            </div>

            <!-- Button -->

            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('customers.index') }}"
                    class="px-6 py-3 rounded-xl bg-gray-200 hover:bg-gray-300">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

                    <i class="fa-solid fa-floppy-disk mr-2"></i>

                    Simpan Customer

                </button>

            </div>

        </form>

    </div>

</div>

@endsection