<aside class="w-72 bg-slate-900 text-white flex flex-col">

    <div class="p-8 border-b border-slate-700">

        <div class="flex items-center gap-3">

            <div
            class="w-14 h-14 rounded-xl bg-blue-600 flex items-center justify-center">

                <i class="fa-solid fa-cart-shopping text-2xl"></i>

            </div>

            <div>

                <h1 class="text-3xl font-bold">

                    POSify

                </h1>

                <span class="text-slate-400">

                    Point Of Sale

                </span>

            </div>

        </div>

    </div>

    <nav class="flex-1 mt-6">

        <ul class="space-y-2 px-5">

            <li>

                <a
                href="/dashboard"

                class="flex items-center gap-4
                px-5 py-3 rounded-xl
                {{ request()->is('dashboard') ? 'bg-blue-600' : '' }}">

                    <i class="fa-solid fa-house"></i>

                    Dashboard

                </a>

            </li>

            <li>

                <a
                href="/products"

                class="flex items-center gap-4
                px-5 py-3 rounded-xl
                {{ request()->is('products') ? 'bg-blue-600' : '' }}">

                    <i class="fa-solid fa-box"></i>

                    Produk

                </a>

            </li>

            <li>

                <a
                href="#"

                class="flex items-center gap-4
                px-5 py-3 rounded-xl
                hover:bg-slate-800
                duration-300">

                    <i class="fa-solid fa-tags"></i>

                    Kategori

                </a>

            </li>

            <li>

                <a
                href="#"

                class="flex items-center gap-4
                px-5 py-3 rounded-xl
                hover:bg-slate-800
                duration-300">

                    <i class="fa-solid fa-truck"></i>

                    Supplier

                </a>

            </li>

            <li>

                <a
                href="#"

                class="flex items-center gap-4
                px-5 py-3 rounded-xl
                hover:bg-slate-800
                duration-300">

                    <i class="fa-solid fa-users"></i>

                    Customer

                </a>

            </li>

            <li>

                <a
                href="#"

                class="flex items-center gap-4
                px-5 py-3 rounded-xl
                hover:bg-slate-800
                duration-300">

                    <i class="fa-solid fa-cash-register"></i>

                    Transaksi

                </a>

            </li>

            <li>

                <a
                href="#"

                class="flex items-center gap-4
                px-5 py-3 rounded-xl
                hover:bg-slate-800
                duration-300">

                    <i class="fa-solid fa-chart-column"></i>

                    Laporan

                </a>

            </li>

        </ul>

    </nav>

    <div class="p-5 border-t border-slate-700">
        <form
            action="/logout"
            method="POST">

            @csrf

            <button
                type="submit"

                class="flex items-center gap-4
                px-5 py-3 rounded-xl
                hover:bg-red-600
                duration-300">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

            </button>
        </form>
    </div>

</aside>