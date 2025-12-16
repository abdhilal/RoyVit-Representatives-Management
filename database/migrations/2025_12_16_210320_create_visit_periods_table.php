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
        Schema::create('visit_periods', function (Blueprint $table) {
            $table->id();
            $table->string('month')->unique(); // مثال: 2025-01
            $table->unsignedInteger('max_visits')->default(5);
            $table->foreignId('warehouse_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visit_periods');
    }
};
