<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POSify</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>

</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    @include('partials.sidebar')

    <div class="flex-1 flex flex-col">

        @include('partials.navbar')

        <main class="flex-1 p-8">

            @yield('content')

        </main>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

document.querySelectorAll('.delete-form').forEach(form => {

    form.addEventListener('submit', function(e){

        e.preventDefault();

        Swal.fire({

            title:'Apakah yakin ingin menghapus?',
            text:'Data yang dihapus tidak dapat dikembalikan!',
            icon:'warning',

            showCancelButton:true,

            confirmButtonColor:'#dc2626',
            cancelButtonColor:'#6b7280',

            confirmButtonText:'Ya, Hapus!',
            cancelButtonText:'Batal'

        }).then((result)=>{

            if(result.isConfirmed){

                form.submit();

            }

        });

    });

});

</script>

@if(session('success'))

<script>

Swal.fire({

    icon:'success',
    title:'Berhasil',
    text:'{{ session('success') }}',

    timer:2000,
    showConfirmButton:false

});

</script>

@endif

{{-- Semua JS halaman akan dimuat di sini --}}
@stack('scripts')

@if(config('midtrans.client_key'))

<script
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

@endif

</body>

</html>