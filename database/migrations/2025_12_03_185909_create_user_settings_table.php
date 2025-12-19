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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->foreignId('id')->constrained('users')->onDelete('cascade');
            $table->enum('layout',['rtl','ltr','Box'])->default('rtl');
            $table->enum('sidebar_type',['Vertical','Horizontal'])->default('Vertical');
            $table->enum('icon',['Stroke','Colorful'])->default('Stroke');
            $table->enum('mode',['Dark','Light','Mix'])->default('Light');
            $table->enum('color',['#308e87','#57375D','#0766AD','#025464','#884A39','#0C356A','#000000'])->default('#308e87');
            $table->enum('locale',['en','ar'])->default('ar');
            $table->primary('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
