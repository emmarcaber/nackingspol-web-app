<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_id')->constrained(
                table: 'users',
                column: 'id',
                indexName: 'orders_cashier_id_foreign'
            );
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->string('transaction_type')->default('');
            $table->string('status')->default('');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
