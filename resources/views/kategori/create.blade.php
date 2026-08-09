@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-8">

    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-gray-800">

            Tambah Kategori

        </h1>

        <p class="text-gray-500 mt-2">

            Tambahkan kategori baru untuk mengelompokkan produk.

        </p>

    </div>

    {{-- Error --}}
    @if ($errors->any())

        <div class="mb-6 rounded-lg border border-red-300 bg-red-50 p-4">

            <ul class="list-disc ml-5 text-red-600">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ route('categories.store') }}" method="POST">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            {{-- Kode --}}
            <div>

                <label class="block mb-2 font-medium text-gray-700">
                    Kode Kategori
                </label>

                <input
                    type="text"
                    name="kode_kategori"
                    value="{{ old('kode_kategori') }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

            </div>

            {{-- Status --}}
            <div>

                <label class="block mb-2 font-medium text-gray-700">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                        Nonaktif
                    </option>

                </select>

            </div>

            {{-- Nama --}}
            <div class="col-span-2">

                <label class="block mb-2 font-medium text-gray-700">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    value="{{ old('nama_kategori') }}"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

            </div>

        </div>

        {{-- Button --}}
        <div class="flex justify-end gap-3 mt-8">

            <a
                href="{{ route('categories.index') }}"
                class="px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-100">

                Batal

            </a>

            <button
                type="submit"
                class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow">

                <i class="fa-solid fa-floppy-disk mr-2"></i>

                Simpan

            </button>

        </div>

    </form>

</div>

@endsection