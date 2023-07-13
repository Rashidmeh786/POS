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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            // $table->integer('employee_id');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->datetime('date');
            $table->time('checkin')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('attend_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
