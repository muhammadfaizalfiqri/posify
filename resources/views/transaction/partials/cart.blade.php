<div class="bg-white rounded-3xl shadow-md overflow-hidden">

    <!-- Header -->
    <div class="px-6 py-5 border-b">

        <h2 class="text-2xl font-bold text-slate-800">
            Keranjang Belanja
        </h2>

    </div>

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr class="text-slate-700">

                    <th class="px-6 py-4 text-left">
                        Kode
                    </th>

                    <th class="px-6 py-4 text-left">
                        Produk
                    </th>

                    <th class="px-6 py-4 text-center">
                        Qty
                    </th>

                    <th class="px-6 py-4 text-right">
                        Harga
                    </th>

                    <th class="px-6 py-4 text-right">
                        Subtotal
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody id="cart-body">

                <tr id="empty-cart">

                    <td colspan="6" class="py-12 text-center text-gray-400">

                        <i class="fa-solid fa-cart-shopping text-4xl mb-3 block"></i>

                        Belum ada produk di keranjang

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>