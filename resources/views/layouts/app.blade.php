<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POSify</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    <div class="flex-1 flex flex-col">

        {{-- Navbar --}}
        @include('partials.navbar')

        {{-- Content --}}
        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>

</body>

</html>