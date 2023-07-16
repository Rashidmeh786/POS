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
        Schema::create('adjustments', function (Blueprint $table) {
           

            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->enum('adjustment_type', ['positive', 'negative']);
            $table->string('reason');
            $table->date('date_of_adjustment');
            $table->unsignedBigInteger('user_id');
            $table->string('reference_number')->nullable();
            $table->timestamps();
    
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adjustments');
    }
};
