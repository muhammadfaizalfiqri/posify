<div id="modalProduk"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-2xl w-full max-w-5xl shadow-2xl overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b">

            <h2 class="text-2xl font-bold">
                Pilih Produk
            </h2>

            <button
                id="closeModal"
                type="button"
                class="text-3xl text-gray-400 hover:text-red-500">

                &times;

            </button>

        </div>

        <!-- Search -->
        <div class="p-5 border-b">

            <input
                id="searchProduk"
                type="text"
                placeholder="Cari produk..."
                class="w-full border rounded-xl p-3">

        </div>

        <!-- Table -->
        <div class="overflow-y-auto max-h-[500px]">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            Kode
                        </th>

                        <th class="px-6 py-4 text-left">
                            Nama
                        </th>

                        <th class="px-6 py-4 text-right">
                            Harga
                        </th>

                        <th class="px-6 py-4 text-center">
                            Stok
                        </th>

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody id="produk-list">

                    @foreach($products as $product)

                    <tr class="border-b hover:bg-slate-50">

                        <td class="px-6 py-4">
                            {{ $product->kode_produk }}
                        </td>

                        <td>
                            {{ $product->nama_produk }}
                        </td>

                        <td class="text-right">
                            Rp {{ number_format($product->harga,0,',','.') }}
                        </td>

                        <td class="text-center">
                            {{ $product->stok }}
                        </td>

                        <td class="text-center">

                            <button
                                class="btnTambah bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg"
                                data-id="{{ $product->id }}"
                                data-kode="{{ $product->kode_produk }}"
                                data-nama="{{ $product->nama_produk }}"
                                data-harga="{{ $product->harga }}">

                                Tambah

                            </button>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>