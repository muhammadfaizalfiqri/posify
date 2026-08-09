<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::with('category')->get()->map(function ($product) {

            return [
                'Kode Produk' => $product->kode_produk,
                'Nama Produk' => $product->nama_produk,
                'Kategori'    => $product->category->kode_kategori . ' - ' . $product->category->nama_kategori,
                'Harga'       => $product->harga,
                'Stok'        => $product->stok,
                'Status'      => $product->status ? 'Aktif' : 'Tidak Aktif',
            ];

        });
    }

    public function headings(): array
    {
        return [
            'Kode Produk',
            'Nama Produk',
            'Kategori',
            'Harga',
            'Stok',
            'Status',
        ];
    }
}