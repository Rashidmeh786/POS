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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');

            // $table->integer('customer_id');
            $table->string('order_date')->nullable();
            $table->string('order_status')->nullable();
            $table->string('total_products')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('vat')->nullable();
            // $table->string('discount')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('ref_no')->nullable();

            $table->float('discount', 10, 0)->nullable()->default(0);
			$table->float('shipping', 10, 0)->nullable()->default(0);
            $table->string('total')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->string('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
