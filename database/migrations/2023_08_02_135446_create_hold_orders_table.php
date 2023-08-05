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
        Schema::create('hold_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');

            // $table->integer('customer_id');
            $table->string('hold_date');
            $table->string('order_status');
            $table->string('discount');
          
            $table->string('hold_no')->nullable();
            $table->string('total')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hold_orders');
    }
};
