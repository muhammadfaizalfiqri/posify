<div class="bg-white rounded-3xl shadow-md p-8">

    <!-- Ringkasan -->
    <div class="space-y-4">

        <div class="flex justify-between items-center">
            <span class="text-gray-600 font-medium">
                Subtotal
            </span>

            <strong
                id="subtotalText"
                class="text-lg">

                Rp0

            </strong>

        </div>

        <div class="flex justify-between items-center">
            <span class="text-gray-600 font-medium">
                Diskon
            </span>

            <strong
                id="diskonText"
                class="text-lg text-red-500">

                Rp0

            </strong>

        </div>

        <hr>

        <div class="flex justify-between items-center">

            <h2 class="text-2xl font-bold text-slate-800">
                Grand Total
            </h2>

            <span
                id="grandTotalText"
                class="text-4xl font-extrabold text-blue-600">

                Rp0

            </span>

        </div>

    </div>

    <!-- Bayar & Kembalian -->
    <div class="grid md:grid-cols-2 gap-6 mt-8">

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Bayar
            </label>

            <div class="mt-8">

                <label class="block text-sm font-medium text-gray-700">
                    Metode Pembayaran
                </label>

                <select
                    id="payment_method"
                    name="payment_method"
                    class="w-full mt-2 rounded-xl border border-gray-300 p-3">

                    <option value="cash">
                        Cash
                    </option>

                    <option value="midtrans">
                        Midtrans
                    </option>

                </select>

            </div>

            <input
                id="bayar"
                name="bayar"
                type="number"
                placeholder="Nominal Bayar"
                class="w-full rounded-xl border border-gray-300 p-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">

        </div>

        <div>

            <label class="block text-sm font-medium text-gray-700 mb-2">
                Kembalian
            </label>

            <input
                id="kembalian"
                readonly
                value="Rp0"
                class="w-full rounded-xl border border-gray-300 bg-gray-100 p-3 font-bold text-blue-600">

        </div>

    </div>

    <!-- Tombol -->
    <div class="flex justify-end gap-4 mt-8">

        <button
            type="reset"
            class="px-8 py-3 rounded-xl border border-gray-300 hover:bg-gray-100 transition">

            Reset

        </button>

        <button
            id="btnSimpan"
            type="submit"
            class="px-8 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">

            <i class="fa-solid fa-floppy-disk mr-2"></i>

            Simpan Transaksi

        </button>

    </div>

    <!-- Hidden Input -->
    <input
        type="hidden"
        id="cartData"
        name="cart">

    <input
        type="hidden"
        id="grandTotalInput"
        name="grand_total">

</div>