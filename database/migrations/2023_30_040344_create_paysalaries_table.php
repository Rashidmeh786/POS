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
        Schema::create('paysalaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');

            $table->string('salary_month')->nullable();
            $table->string('salary_year')->nullable();
            $table->enum('salary_status', ['paid', 'unpaid'])->default('unpaid');
            $table->string('paid_amount')->nullable();
            $table->string('advance_salary')->nullable();
            $table->string('due_salary')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paysalaries');
    }
};
