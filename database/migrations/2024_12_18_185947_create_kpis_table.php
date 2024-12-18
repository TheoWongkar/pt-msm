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
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees', indexName: 'kpis_employee_id')->onDelete('cascade');
            $table->string('description');
            $table->integer('weight');
            $table->integer('rating');
            $table->float('value');
            $table->timestamps();
        });

        Schema::create('kpi_totals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees', indexName: 'kpi_totals_employee_id')->onDelete('cascade');
            $table->float('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kpis');
        Schema::dropIfExists('kpi_totals');
    }
};
