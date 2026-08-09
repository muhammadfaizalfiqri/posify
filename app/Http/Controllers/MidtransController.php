<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function notification(Request $request): JsonResponse
    {
    Log::info('MIDTRANS NOTIFICATION:', $request->all());

        return response()->json([
            'success' => true,
            'message' => 'Notification received',
        ]);
    }
}