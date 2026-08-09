<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $sales = Transaction::sum('total');

    $transactions = Transaction::count();

    $jumlahProduk = Product::count();

    $jumlahCustomer = Customer::count();

    $latestTransactions = Transaction::with('customer')
        ->latest()
        ->take(5)
        ->get();

    /*
    |--------------------------------------------------------------------------
    | Grafik 7 Hari
    |--------------------------------------------------------------------------
    */

    $labels = [];
    $data = [];

    for ($i = 6; $i >= 0; $i--) {

        $tanggal = Carbon::now()->subDays($i);

        $labels[] = $tanggal->format('d M');

        $data[] = Transaction::whereDate(
            'created_at',
            $tanggal->toDateString()
        )->sum('total');

    }

    /*
    |--------------------------------------------------------------------------
    | Aktivitas
    |--------------------------------------------------------------------------
    */

   $activities = Transaction::with('customer')
    ->latest()
    ->take(5)
    ->get()
    ->map(function ($trx) {

        return [

            'title' => 'Transaksi ' . $trx->invoice .
                       ' oleh ' . ($trx->customer->nama_customer ?? 'Customer Umum'),

            'time' => $trx->created_at->diffForHumans(),

            'icon' => 'fa-cart-shopping',

            'class' => 'text-green-500',

        ];

    });

    $stats = [

        'sales' => $sales,

        'transactions' => $transactions,

    ];

    $labels = [];
    $data = [];

    for ($i = 6; $i >= 0; $i--) {

        $tanggal = Carbon::now()->subDays($i);

        $labels[] = $tanggal->translatedFormat('D');

        $data[] = Transaction::whereDate('created_at', $tanggal)
                    ->sum('total');

    }

    return view('dashboard', compact(

        'stats',

        'activities',

        'jumlahProduk',

        'jumlahCustomer',

        'latestTransactions',

        'labels',

        'data'

    ));

    }
}