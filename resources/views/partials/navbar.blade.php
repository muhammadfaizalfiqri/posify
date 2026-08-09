<header
class="bg-white shadow-sm px-8 py-5 flex justify-between items-center">

    <div>

        <h2 class="text-3xl font-bold text-slate-800">

            @yield('title')

        </h2>

        <p class="text-slate-500">

            Welcome back 👋

        </p>

    </div>

    <div class="flex items-center gap-6">

        <div class="relative" id="notificationWrapper">

            <button
                type="button"
                id="notificationButton"
                class="relative p-2 text-gray-700 hover:text-blue-600">

                <i class="fa-solid fa-bell text-xl"></i>

                <span
                    id="notificationBadge"
                    class="hidden absolute -top-1 -right-1
                        min-w-[20px] h-[20px]
                        px-1 rounded-full
                        bg-red-500 text-white
                        text-xs font-bold
                        flex items-center justify-center">
                    0
                </span>

            </button>

            <div
                id="notificationDropdown"
                class="hidden absolute right-0 mt-3
                    w-96 bg-white rounded-xl
                    shadow-xl border border-gray-200
                    z-50">

                <div class="flex items-center justify-between
                            px-5 py-4 border-b">

                    <div>
                        <h3 class="font-bold text-gray-800">
                            Notifikasi
                        </h3>

                        <p
                            id="notificationCountText"
                            class="text-xs text-gray-400">
                            Memuat...
                        </p>
                    </div>

                    <button
                        type="button"
                        id="markAllRead"
                        class="text-sm text-blue-600 hover:underline">
                        Tandai semua dibaca
                    </button>

                </div>

                <div
                    id="notificationList"
                    class="max-h-96 overflow-y-auto">

                    <div class="p-6 text-center text-gray-400">
                        Memuat notifikasi...
                    </div>

                </div>

            </div>

        </div>

        <div class="flex items-center gap-3">

            <img

            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff&size=128"

            class="w-12 h-12 rounded-full">

            <div>

                <h4 class="font-semibold">

                    {{ Auth::user()->name }}

                </h4>

                <span class="text-sm text-slate-500">

                    {{ Auth::user()->role }}

                </span>

            </div>

        </div>

    </div>

</header>