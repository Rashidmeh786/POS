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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('category_id');
            $table->integer('supplier_id')->nullable();
            $table->string('product_code')->unique();
            $table->string('product_garage')->nullable();
            $table->string('product_store')->nullable();
            $table->string('product_image')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('buying_date')->nullable();
            $table->string('expire_date')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price')->nullable(); 
            $table->integer('purchase_unit_id')->nullable(); 
            $table->integer('sale_unit_id')->nullable(); 
            $table->integer('stock')->nullable(); 
            $table->integer('alertqty')->nullable();
            $table->enum('status', ['available', 'unavailable'])->default('unavailable');
            // $table->string('sku')->unique();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
