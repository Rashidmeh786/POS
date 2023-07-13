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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();;
            $table->string('phone');
            $table->text('address')->nullable(); 
            $table->string('shopname')->nullable(); 
            $table->string('image')->nullable();;
            $table->string('account_holder')->nullable(); 
            $table->string('account_number')->nullable(); 
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('city')->nullable(); 
            // $table->string('cnic')->unique();
            // Update the customers table

    $table->string('cnic')->nullable();


            // $table->decimal('total_due', 8, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
