@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

<div class="bg-white rounded-xl shadow-md p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Data Kategori
            </h1>

            <p class="text-gray-500 text-sm">
                Kelola seluruh kategori produk
            </p>
        </div>

        <a href="{{ route('categories.create') }}"
            class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">

            <i class="fa-solid fa-plus mr-2"></i>
            Tambah Kategori

        </a>

    </div>

    {{-- Search --}}
    <form method="GET" class="mb-5">

        <div class="relative">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari kategori..."
                class="w-full border rounded-lg pl-11 pr-4 py-3 focus:ring-2 focus:ring-blue-500 outline-none">

            <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

        </div>

    </form>

    {{-- Table --}}
    <div class="overflow-x-auto">

        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">

            <thead class="bg-gray-100">

                <tr class="text-left text-gray-700">

                    <th class="px-5 py-3">No</th>
                    <th class="px-5 py-3">Kode</th>
                    <th class="px-5 py-3">Nama Kategori</th>
                    <th class="px-5 py-3">Status</th>
                    <th class="px-5 py-3 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-5 py-3">
                            {{ $loop->iteration + ($categories->currentPage()-1) * $categories->perPage() }}
                        </td>

                        <td class="px-5 py-3 font-medium">
                            {{ $category->kode_kategori }}
                        </td>

                        <td class="px-5 py-3">
                            {{ $category->nama_kategori }}
                        </td>

                        <td class="px-5 py-3">

                            @if($category->status)

                                <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                    Aktif
                                </span>

                            @else

                                <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                        <td class="px-5 py-3">

                            <div class="flex justify-center gap-2">

                                {{-- Detail --}}
                                <a href="{{ route('categories.show',$category->id) }}"
                                    class="w-9 h-9 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-500 hover:text-white">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('categories.edit',$category->id) }}"
                                    class="w-9 h-9 rounded-lg bg-yellow-100 text-yellow-600 flex items-center justify-center hover:bg-yellow-500 hover:text-white">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('categories.destroy',$category->id) }}"
                                    method="POST"
                                    class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="w-9 h-9 rounded-lg bg-red-100 text-red-600 hover:bg-red-500 hover:text-white">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center py-8 text-gray-500">

                            Belum ada data kategori.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="mt-6">

        {{ $categories->links() }}

    </div>

</div>

@endsection