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
        Schema::create('order_returns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            // $table->unsignedBigInteger('order_id');

            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');

            // $table->integer('customer_id');
            
            $table->string('order_date');
            $table->string('order_status')->nullable();;
            $table->string('total_products');
            $table->string('sub_total')->nullable();
            $table->string('vat')->nullable();
            $table->string('discount')->nullable();
            $table->string('shipping')->nullable();

            $table->string('invoice_no')->nullable();
            $table->string('total')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_returns');
    }
};
