@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')

<div class="space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Transaksi Penjualan
        </h1>

        <p class="text-slate-500 mt-1">
            Buat transaksi penjualan baru.
        </p>
    </div>

    <form
        id="transactionForm"
        action="{{ route('transactions.store') }}"
        method="POST"
        class="space-y-6">

        @csrf

        {{-- Invoice --}}
        @include('transaction.partials.invoice')

        {{-- Tambah Produk --}}
        @include('transaction.partials.product-search')

        {{-- Cart + Summary --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2">
                @include('transaction.partials.cart')
            </div>

            <div>
                @include('transaction.partials.summary')
            </div>

        </div>

    </form>

</div>

@include('transaction.partials.modal-product')

@endsection

@push('scripts')
    @vite('resources/js/transaction/index.js')
@endpush