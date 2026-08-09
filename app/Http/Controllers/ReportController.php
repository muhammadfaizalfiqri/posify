<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('customer')
                    ->latest();

        // Filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->paginate(10);

        return view('reports.index', compact('transactions'));
    }

    public function export(Request $request)
{
    $transactions = Transaction::with('customer')
        ->when($request->start_date, function ($query) use ($request) {
            $query->whereDate('created_at', '>=', $request->start_date);
        })
        ->when($request->end_date, function ($query) use ($request) {
            $query->whereDate('created_at', '<=', $request->end_date);
        })
        ->latest()
        ->get();

    $response = new StreamedResponse(function () use ($transactions) {

        $handle = fopen('php://output', 'w');

        // Header CSV
        fputcsv($handle, [
            'Invoice',
            'Tanggal',
            'Customer',
            'Subtotal',
            'Diskon',
            'Total',
            'Bayar',
            'Kembalian'
        ]);

        foreach ($transactions as $trx) {

            fputcsv($handle, [

                $trx->invoice,
                $trx->created_at->format('d-m-Y H:i'),
                $trx->customer->nama_customer ?? '-',
                $trx->subtotal,
                $trx->diskon,
                $trx->total,
                $trx->bayar,
                $trx->kembalian,

            ]);

        }

        fclose($handle);

    });

    $response->headers->set(
        'Content-Type',
        'text/csv'
    );

    $response->headers->set(
        'Content-Disposition',
        'attachment; filename="laporan_penjualan.csv"'
    );

    return $response;
}

public function show(Transaction $transaction)
{
    $transaction->load([
        'customer',
        'details.product'
    ]);

    return view('reports.show', compact('transaction'));
}

public function print(Transaction $transaction)
{
    $transaction->load([
        'customer',
        'details.product'
    ]);

    return view('reports.print', compact('transaction'));
}
}