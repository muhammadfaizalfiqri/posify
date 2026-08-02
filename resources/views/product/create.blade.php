@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl shadow-lg p-8">

        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold text-gray-800">
                    Tambah Produk
                </h1>

                <p class="text-gray-500 mt-1">
                    Tambahkan produk baru ke dalam sistem POS.
                </p>

            </div>

            <a href="{{ route('products.index') }}"
                class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 duration-300">

                Kembali

            </a>

        </div>

        {{-- Error Validation --}}
        @if ($errors->any())

            <div class="mb-6 rounded-lg bg-red-100 border border-red-300 text-red-700 p-4">

                <ul class="list-disc ml-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('products.store') }}" method="POST" class="space-y-6">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama Produk --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Nama Produk
                    </label>

                    <input
                        type="text"
                        name="nama_produk"
                        value="{{ old('nama_produk') }}"
                        placeholder="Masukkan nama produk"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                {{-- Kode Produk --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Kode Produk
                    </label>

                    <input
                        type="text"
                        name="kode_produk"
                        value="{{ old('kode_produk') }}"
                        placeholder="Contoh : BRG001"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Kategori
                    </label>

                    <input
                        type="text"
                        name="kategori"
                        value="{{ old('kategori') }}"
                        placeholder="Makanan, Minuman, dll"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                {{-- Harga --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Harga
                    </label>

                    <input
                        type="number"
                        name="harga"
                        value="{{ old('harga') }}"
                        placeholder="0"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                {{-- Stok --}}
                <div>
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Stok
                    </label>

                    <input
                        type="number"
                        name="stok"
                        value="{{ old('stok') }}"
                        placeholder="0"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                </div>

                {{-- Status --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-semibold text-gray-700">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3
                        focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

                        <option value="">-- Pilih Status --</option>

                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>
                </div>

            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4 border-t">

                <a href="{{ route('products.index') }}"
                    class="px-6 py-3 rounded-xl border border-gray-300 text-gray-600 hover:bg-gray-100">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-md">

                    <i class="fa-solid fa-floppy-disk mr-2"></i>
                    Simpan Produk

                </button>

            </div>

        </form>

    </div>

</div>

@endsection