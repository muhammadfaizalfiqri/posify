@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-8 py-6">

            <h1 class="text-2xl font-bold text-white">
                Detail Produk
            </h1>

            <p class="text-blue-100 mt-1">
                Informasi lengkap produk.
            </p>

        </div>

        {{-- Body --}}
        <div class="p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama Produk --}}
                <div>
                    <label class="text-sm text-gray-500">Nama Produk</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $product->nama_produk }}
                    </div>
                </div>

                {{-- Kode --}}
                <div>
                    <label class="text-sm text-gray-500">Kode Produk</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $product->kode_produk }}
                    </div>
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="text-sm text-gray-500">Kategori</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $product->category->kode_kategori }} - {{ $product->category->nama_kategori }}
                    </div>
                </div>

                {{-- Harga --}}
                <div>
                    <label class="text-sm text-gray-500">Harga</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3 font-semibold text-green-600">
                        Rp {{ number_format($product->harga,0,',','.') }}
                    </div>
                </div>

                {{-- Stok --}}
                <div>
                    <label class="text-sm text-gray-500">Stok</label>

                    <div class="mt-2 bg-gray-50 border rounded-xl px-4 py-3">
                        {{ $product->stok }}
                    </div>
                </div>

                {{-- Status --}}
                <div>
                    <label class="text-sm text-gray-500">Status</label>

                    <div class="mt-2">

                        @if($product->status)

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-medium">
                                Aktif
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-medium">
                                Nonaktif
                            </span>

                        @endif

                    </div>

                </div>

                </div>

            </div>

        </div>

        {{-- Footer --}}
        <div class="border-t bg-gray-50 px-8 py-5 flex justify-end gap-3">

            <a href="{{ route('products.index') }}"
                class="px-5 py-3 rounded-xl border border-gray-300 hover:bg-gray-100">

                Kembali

            </a>

            <a href="{{ route('products.edit',$product->id) }}"
                class="px-5 py-3 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white">

                <i class="fa-solid fa-pen mr-2"></i>

                Edit

            </a>

        </div>

    </div>

</div>

@endsection