<div class="bg-white rounded-3xl shadow-md p-6">

    <div class="grid md:grid-cols-2 gap-6">

        {{-- Invoice --}}
        <div>

            <label class="font-medium text-gray-700">
                Invoice
            </label>

            <input
                type="text"
                readonly
                value="{{ $invoice }}"
                class="w-full mt-2 rounded-xl border border-slate-300 bg-gray-100 p-3">

        </div>


        {{-- Customer --}}
        <div>

            <label class="font-medium text-gray-700">
                Customer
            </label>

            <select
                name="customer_id"
                id="customer_id"
                class="w-full mt-2 rounded-xl border border-slate-300 p-3">

                <option value="">
                    Pilih Customer
                </option>

                @foreach($customers as $customer)

                    <option value="{{ $customer->id }}">

                        {{ $customer->nama_customer }}

                    </option>

                @endforeach

            </select>

        </div>

    </div>

</div>