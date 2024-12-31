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
            $table->foreignId('department_id')->constrained('departments', indexName: 'employees_department_id')->onDelete('cascade');
            $table->string('nik', 20)->unique();
            $table->string('name');
            $table->string('phone', 20)->nullable();
            $table->string('address');
            $table->date('date_of_birth');
            $table->enum('gender', ['Pria', 'Wanita']);
            $table->string('position');
            $table->date('date_of_entry')->nullable();
            $table->string('profile_picture')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
