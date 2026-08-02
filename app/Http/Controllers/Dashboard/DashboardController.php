<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [

            'sales' => 18250000,

            'products' => 125,

            'customers' => 86,

            'transactions' => 52,

        ];

        $activities = [

    [
        'title' => 'Produk baru ditambahkan',
        'time' => '2 menit lalu',
        'icon' => 'fa-box',
        'class' => 'text-blue-500',
    ],

    [
        'title' => 'Supplier baru',
        'time' => '15 menit lalu',
        'icon' => 'fa-truck',
        'class' => 'text-green-500',
    ],

    [
        'title' => 'Transaksi berhasil',
        'time' => '30 menit lalu',
        'icon' => 'fa-cart-shopping',
        'class' => 'text-purple-500',
    ],

];

$jumlahProduk = Product::count();

        return view('dashboard',compact('stats','activities','jumlahProduk'));
    }
}