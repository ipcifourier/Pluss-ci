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
        Schema::create('team_members', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nom complet
        $table->string('position'); // Fonction (ex: Coordonnatrice, Chargé de santé humaine...)
        $table->string('department'); // Le pôle (Secrétariat Multisectoriel ou Équipe d'appui)
        $table->longText('description')->nullable(); // Petite bio ou missions
        $table->string('image_path')->nullable(); // La photo
        $table->integer('sort_order')->default(0); // Pour forcer la coordonnatrice en premier
        $table->boolean('is_active')->default(true); // Pour masquer quelqu'un sans le supprimer
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
