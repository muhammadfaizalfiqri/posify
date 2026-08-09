<?php

namespace App\Notifications;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TransactionNotification extends Notification
{
    use Queueable;

    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'transaction',
            'title' => 'Transaksi Baru',
            'message' => 'Transaksi ' . $this->transaction->invoice . ' berhasil dibuat.',
            'transaction_id' => $this->transaction->id,
            'invoice' => $this->transaction->invoice,
            'total' => $this->transaction->total,
            'payment_method' => $this->transaction->payment_method,
        ];
    }
}