<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
{
    $products = [
        [
            'name' => 'Aqua 600ml',
            'category' => 'Minuman',
            'price' => '5000',
            'stock' => 120,
            'status' => 'Aktif'
        ],
        [
            'name' => 'Indomie Goreng',
            'category' => 'Makanan',
            'price' => '3500',
            'stock' => 250,
            'status' => 'Aktif'
        ],
        [
            'name' => 'Teh Botol',
            'category' => 'Minuman',
            'price' => '7000',
            'stock' => 85,
            'status' => 'Aktif'
        ],
    ];

    return view('product.index', compact('products'));
}
}
