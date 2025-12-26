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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->foreignId('classification_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('specialization_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('warehouse_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('area_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('representative_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('visits_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
