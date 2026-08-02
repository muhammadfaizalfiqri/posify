@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="px-8 py-6 border-b bg-gradient-to-r from-blue-600 to-blue-500">

            <h1 class="text-2xl font-bold text-white">
                Edit Produk
            </h1>

            <p class="text-blue-100 mt-1">
                Perbarui informasi produk.
            </p>

        </div>

        <form action="{{ route('products.update',$product->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="p-8">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama Produk --}}
                    <div class="md:col-span-2">

                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Nama Produk
                        </label>

                        <input
                            type="text"
                            name="nama_produk"
                            value="{{ old('nama_produk',$product->nama_produk) }}"
                            placeholder="Masukkan nama produk"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    </div>

                    {{-- Kode Produk --}}
                    <div>

                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Kode Produk
                        </label>

                        <input
                            type="text"
                            name="kode_produk"
                            value="{{ old('kode_produk',$product->kode_produk) }}"
                            placeholder="Contoh : BRG001"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    </div>

                    {{-- Kategori --}}
                    <div>

                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Kategori
                        </label>

                        <input
                            type="text"
                            name="kategori"
                            value="{{ old('kategori',$product->kategori) }}"
                            placeholder="Masukkan kategori"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    </div>

                    {{-- Harga --}}
                    <div>

                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Harga
                        </label>

                        <input
                            type="number"
                            name="harga"
                            value="{{ old('harga',$product->harga) }}"
                            placeholder="0"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    </div>

                    {{-- Stok --}}
                    <div>

                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Stok
                        </label>

                        <input
                            type="number"
                            name="stok"
                            value="{{ old('stok',$product->stok) }}"
                            placeholder="0"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    </div>

                    {{-- Status --}}
                    <div class="md:col-span-2">

                        <label class="block mb-2 text-sm font-semibold text-gray-700">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                            <option value="1"
                                {{ old('status',$product->status) ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="0"
                                {{ old('status',$product->status) == 0 ? 'selected' : '' }}>
                                Nonaktif
                            </option>

                        </select>

                    </div>

                </div>

            </div>

            {{-- Footer --}}
            <div class="border-t bg-gray-50 px-8 py-5 flex justify-end gap-3">

                <a href="{{ route('products.index') }}"
                    class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 duration-300">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow">

                    <i class="fa-solid fa-pen-to-square mr-2"></i>

                    Update Produk

                </button>

            </div>

        </form>

    </div>

</div>

@endsection