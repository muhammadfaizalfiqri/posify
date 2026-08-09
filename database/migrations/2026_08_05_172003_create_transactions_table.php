<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {

            $table->id();

            $table->string('invoice')->unique();

            $table->foreignId('customer_id')
                  ->nullable()
                  ->constrained('customers')
                  ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Payment
            |--------------------------------------------------------------------------
            */

            $table->string('payment_method')->default('cash');
            // cash | midtrans

            $table->string('payment_status')->default('paid');
            // pending | paid | expire | cancel

            $table->string('midtrans_order_id')->nullable();

            $table->text('snap_token')->nullable();

            $table->timestamp('paid_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Nominal
            |--------------------------------------------------------------------------
            */

            $table->decimal('subtotal',15,2)->default(0);

            $table->decimal('diskon',15,2)->default(0);

            $table->decimal('total',15,2);

            $table->decimal('bayar',15,2)->default(0);

            $table->decimal('kembalian',15,2)->default(0);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};