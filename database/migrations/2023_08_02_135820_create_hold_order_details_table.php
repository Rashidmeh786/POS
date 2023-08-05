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
        Schema::create('hold_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hold_id')->constrained('hold_orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            // $table->integer('order_id');
            // $table->integer('product_id');
            $table->string('quantity')->nullable();
            $table->string('unitcost')->nullable();
            $table->string('total')->nullable();
            $table->timestamps();
        });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hold_order_details');
    }
};
