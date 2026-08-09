@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg">

    {{-- Header --}}
    <div class="flex justify-between items-center border-b px-8 py-6">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Detail Kategori
            </h1>

            <p class="text-gray-500 mt-1">
                Informasi lengkap kategori.
            </p>

        </div>

        <div class="flex gap-3">

            <a href="{{ route('categories.edit',$category->id) }}"
                class="px-5 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg text-white">

                <i class="fa-solid fa-pen mr-2"></i>

                Edit

            </a>

            <a href="{{ route('categories.index') }}"
                class="px-5 py-2 bg-gray-500 hover:bg-gray-600 rounded-lg text-white">

                <i class="fa-solid fa-arrow-left mr-2"></i>

                Kembali

            </a>

        </div>

    </div>

    {{-- Body --}}
    <div class="p-8">

        <div class="grid grid-cols-2 gap-8">

            {{-- Kode --}}
            <div>

                <label class="text-sm text-gray-500">
                    Kode Kategori
                </label>

                <div class="mt-2 font-semibold text-lg text-gray-800">

                    {{ $category->kode_kategori }}

                </div>

            </div>

            {{-- Status --}}
            <div>

                <label class="text-sm text-gray-500">
                    Status
                </label>

                <div class="mt-2">

                    @if($category->status)

                        <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 font-semibold">

                            Aktif

                        </span>

                    @else

                        <span class="px-4 py-2 rounded-full bg-red-100 text-red-700 font-semibold">

                            Nonaktif

                        </span>

                    @endif

                </div>

            </div>

            {{-- Nama --}}
            <div class="col-span-2">

                <label class="text-sm text-gray-500">
                    Nama Kategori
                </label>

                <div class="mt-2 font-semibold text-lg text-gray-800">

                    {{ $category->nama_kategori }}

                </div>

            </div>
            
        {{-- Footer --}}
        <div class="border-t mt-10 pt-6">

            <div class="grid grid-cols-2 gap-6">

                <div>

                    <label class="text-sm text-gray-500">
                        Dibuat Pada
                    </label>

                    <div class="mt-1">

                        {{ $category->created_at->format('d F Y H:i') }}

                    </div>

                </div>

                <div>

                    <label class="text-sm text-gray-500">
                        Terakhir Diubah
                    </label>

                    <div class="mt-1">

                        {{ $category->updated_at->format('d F Y H:i') }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection