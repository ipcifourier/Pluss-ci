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
        Schema::create('partners', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Nom du partenaire
        $table->string('logo_path')->nullable(); // Logo
        $table->string('website_url')->nullable(); // Lien vers leur site
        $table->text('description')->nullable(); // Petite description de l'appui
        $table->integer('sort_order')->default(10); // Ordre d'affichage
        $table->boolean('is_active')->default(true); // Afficher ou masquer
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
