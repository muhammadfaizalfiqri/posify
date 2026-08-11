<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransNotificationController extends Controller
{
    public function handle(Request $request)
    {
        try {
            $notification = $request->all();

            Log::info('MIDTRANS WEBHOOK RECEIVED', [
                'data' => $notification,
            ]);

            $orderId = $notification['order_id'] ?? null;
            $statusCode = $notification['status_code'] ?? null;
            $grossAmount = $notification['gross_amount'] ?? null;
            $signatureKey = $notification['signature_key'] ?? null;

            /*
            |--------------------------------------------------------------------------
            | VALIDATE DATA
            |--------------------------------------------------------------------------
            */

            if (
                !$orderId ||
                !$statusCode ||
                !$grossAmount ||
                !$signatureKey
            ) {
                Log::warning('MIDTRANS WEBHOOK DATA INCOMPLETE', [
                    'data' => $notification,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Data notification tidak lengkap.',
                ], 400);
            }

            /*
            |--------------------------------------------------------------------------
            | VERIFY SIGNATURE
            |--------------------------------------------------------------------------
            */

            $serverKey = config('midtrans.server_key');

            $signature = hash(
                'sha512',
                $orderId .
                $statusCode .
                $grossAmount .
                $serverKey
            );

            if (!hash_equals($signature, $signatureKey)) {
                Log::warning('MIDTRANS WEBHOOK INVALID SIGNATURE', [
                    'order_id' => $orderId,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Invalid signature.',
                ], 403);
            }

            /*
            |--------------------------------------------------------------------------
            | FIND TRANSACTION
            |--------------------------------------------------------------------------
            */

            $transaction = Transaction::where(
                'invoice',
                $orderId
            )->first();

            if (!$transaction) {
                Log::warning('MIDTRANS TRANSACTION NOT FOUND', [
                    'order_id' => $orderId,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Transaction not found.',
                ], 404);
            }

            /*
            |--------------------------------------------------------------------------
            | GET MIDTRANS STATUS
            |--------------------------------------------------------------------------
            */

            $transactionStatus =
                $notification['transaction_status'] ?? null;

            /*
            |--------------------------------------------------------------------------
            | UPDATE TRANSACTION
            |--------------------------------------------------------------------------
            */

            switch ($transactionStatus) {

                case 'settlement':

                    $transaction->update([
                        'status' => 'paid',
                    ]);

                    break;

                case 'capture':

                    $fraudStatus =
                        $notification['fraud_status'] ?? null;

                    if ($fraudStatus === 'accept') {
                        $transaction->update([
                            'status' => 'paid',
                        ]);
                    }

                    break;

                case 'pending':

                    $transaction->update([
                        'status' => 'pending',
                    ]);

                    break;

                case 'expire':

                    $transaction->update([
                        'status' => 'expired',
                    ]);

                    break;

                case 'cancel':

                    $transaction->update([
                        'status' => 'cancelled',
                    ]);

                    break;

                case 'deny':

                    $transaction->update([
                        'status' => 'failed',
                    ]);

                    break;

                case 'refund':
                case 'partial_refund':

                    $transaction->update([
                        'status' => 'refunded',
                    ]);

                    break;
            }

            /*
            |--------------------------------------------------------------------------
            | LOG SUCCESS
            |--------------------------------------------------------------------------
            */

            Log::info('MIDTRANS TRANSACTION UPDATED', [
                'order_id' => $orderId,
                'status' => $transactionStatus,
                'transaction_id' => $transaction->id,
            ]);

            /*
            |--------------------------------------------------------------------------
            | RESPONSE
            |--------------------------------------------------------------------------
            */

            return response()->json([
                'success' => true,
                'message' => 'Notification received.',
            ], 200);

        } catch (\Throwable $e) {

            Log::error('MIDTRANS WEBHOOK ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Webhook processing failed.',
            ], 500);
        }
    }
}