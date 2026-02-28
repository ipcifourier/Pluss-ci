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
        Schema::create('documents', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('file_path'); // Le chemin vers le PDF
        $table->string('type'); // Ex: 'Rapport', 'Bulletin', 'Arrêté'
        $table->integer('download_count')->default(0); // Stats de téléchargement
        $table->boolean('is_public')->default(true);
        $table->timestamps();
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
