<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

        Customer::create([
            'name' => 'Visitor Customer',
            'email' => 'walkin@example.com',
            'phone' => 000000000000,
            'address'=>'visitor',
            'city'=>'peshawar',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
