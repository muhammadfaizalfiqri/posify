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

        <button class="relative">

            <i class="fa-regular fa-bell text-2xl"></i>

            <span
            class="absolute
            -top-1
            -right-1
            w-2.5
            h-2.5
            rounded-full
            bg-red-500">

            </span>

        </button>

        <div class="flex items-center gap-3">

            <img

            src="https://ui-avatars.com/api/?name=Muhammad+Faiz"

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