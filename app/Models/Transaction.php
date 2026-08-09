<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [

    'invoice',

    'customer_id',

    'payment_method',

    'payment_status',

    'midtrans_order_id',

    'snap_token',

    'paid_at',

    'subtotal',

    'diskon',

    'total',

    'bayar',

    'kembalian',

];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}