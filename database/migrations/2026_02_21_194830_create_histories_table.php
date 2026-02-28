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
        Schema::create('histories', function (Blueprint $table) {
        $table->id();
        $table->integer('year')->unique(); // L'année (ex: 2019, 2020)
        $table->text('content'); // Les acquis / la description
        $table->boolean('is_active')->default(true); // Pour masquer temporairement une année
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
