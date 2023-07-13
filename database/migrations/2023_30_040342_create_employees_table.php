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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('fname');
            $table->date('dob');
            $table->string('cnic')->unique();
            $table->string('email');
            $table->string('phone');
            $table->string('ephone');
            $table->string('address')->nullable(); 
            $table->date('joiningdate');
            $table->string('experience')->nullable(); 
            $table->string('image')->nullable();
            $table->string('salary')->nullable(); 
            $table->string('vacation')->nullable(); 
            $table->string('city')->nullable(); 
            $table->string('designation')->nullable();
            $table->string('gender')->nullable();;
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('additionall_info')->nullable();
            $table->timestamps();
            // $table->integer('designation_id');
            $table->foreignId('designation_id')->constrained('designations')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');

         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
