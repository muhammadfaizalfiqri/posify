<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\MidtransService;
use App\Notifications\TransactionNotification;

class TransactionController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    public function index()
    {
        $customers = Customer::orderBy('nama_customer')->get();

        $products = Product::where('status', 1)
            ->orderBy('nama_produk')
            ->get();

        $invoice = 'TRX-' . date('Ymd') . '-' . str_pad(
            Transaction::count() + 1,
            4,
            '0',
            STR_PAD_LEFT
        );

        return view('transaction.index', compact(
            'customers',
            'products',
            'invoice'
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
{
    $request->validate([

        'customer_id' => 'nullable|exists:customers,id',

        'payment_method' => 'required|in:cash,midtrans',

        'cart' => 'required',

        'bayar' => 'required_if:payment_method,cash|nullable|numeric|min:0',

    ]);

    $cart = json_decode($request->cart, true);

    if (!$cart || count($cart) === 0) {

        return response()->json([
            'success' => false,
            'message' => 'Keranjang kosong.'
        ], 422);

    }

    DB::beginTransaction();

    try {

        /*
        |--------------------------------------------------------------------------
        | HITUNG TOTAL
        |--------------------------------------------------------------------------
        */

        $subtotal = 0;

        foreach ($cart as $item) {

            $subtotal += $item['qty'] * $item['harga'];

        }

        $bayar = $request->payment_method === 'cash'
            ? (float) $request->bayar
            : 0;

        $kembalian = $request->payment_method === 'cash'
            ? $bayar - $subtotal
            : 0;


        /*
        |--------------------------------------------------------------------------
        | BUAT TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $transaction = Transaction::create([

            'invoice' => 'TRX-' . now()->format('YmdHis'),

            'customer_id' => $request->customer_id,

            'payment_method' => $request->payment_method,

            'payment_status' => $request->payment_method === 'cash'
                ? 'paid'
                : 'pending',

            'subtotal' => $subtotal,

            'diskon' => 0,

            'total' => $subtotal,

            'bayar' => $bayar,

            'kembalian' => $kembalian,

            'paid_at' => $request->payment_method === 'cash'
                ? now()
                : null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | DETAIL TRANSAKSI
        |--------------------------------------------------------------------------
        */

        foreach ($cart as $item) {

            TransactionDetail::create([

                'transaction_id' => $transaction->id,

                'product_id' => $item['id'],

                'qty' => $item['qty'],

                'harga' => $item['harga'],

                'subtotal' => $item['qty'] * $item['harga'],

            ]);


            /*
            |--------------------------------------------------------------------------
            | KURANGI STOK
            |--------------------------------------------------------------------------
            */

            $product = Product::find($item['id']);

            if (!$product) {

                throw new \Exception(
                    'Produk dengan ID ' . $item['id'] . ' tidak ditemukan.'
                );

            }

            if ($product->stok < $item['qty']) {

                throw new \Exception(
                    'Stok produk ' . $product->nama_produk . ' tidak mencukupi.'
                );

            }

            $product->decrement(
                'stok',
                $item['qty']
            );

        }


        /*
        |--------------------------------------------------------------------------
        | MIDTRANS
        |--------------------------------------------------------------------------
        */

        if ($transaction->payment_method === 'midtrans') {

            $customer = $transaction->customer;

            $snapToken = $this->midtrans->createSnapToken(
                $transaction,
                $customer
            );

            $transaction->update([

                'snap_token' => $snapToken,

                'midtrans_order_id' => $transaction->invoice,

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | COMMIT TRANSACTION
        |--------------------------------------------------------------------------
        */

        DB::commit();


        /*
        |--------------------------------------------------------------------------
        | NOTIFICATION
        |--------------------------------------------------------------------------
        */

        if (auth()->check()) {

            auth()->user()->notify(
                new TransactionNotification($transaction)
            );

        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSE CASH
        |--------------------------------------------------------------------------
        */

        if ($transaction->payment_method === 'cash') {

            return response()->json([

                'success' => true,

                'payment_method' => 'cash',

                'message' => 'Transaksi berhasil.',

            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSE MIDTRANS
        |--------------------------------------------------------------------------
        */

        return response()->json([

            'success' => true,

            'payment_method' => 'midtrans',

            'snap_token' => $transaction->snap_token,

            'invoice' => $transaction->invoice,

        ]);


    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([

            'success' => false,

            'message' => $e->getMessage(),

        ], 500);

    }
}      

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}