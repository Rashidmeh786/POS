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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
        $table->date('date')->nullable();;
        $table->string('title')->nullable();;
        $table->string('ref_no')->nullable();;
        $table->unsignedBigInteger('category_id');
        $table->unsignedBigInteger('user_id')->nullable();;
        $table->text('details')->nullable();
        $table->timestamps();
        $table->string('amount')->nullable();;
        $table->foreign('category_id')->references('id')->on('expense_categories')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
