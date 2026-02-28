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
        Schema::create('gtts', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Ex: GTT Santé, GTT Éducation
        $table->string('slug')->unique(); // Pour les URLs: pluss.ci/gtt/sante
        $table->string('leader')->nullable(); // Nom du leader ou responsable du GTT
        $table->text('short_description')->nullable(); // Pour les cartes d'aperçu
        $table->longText('description')->nullable(); // Présentation complète
        $table->string('logo')->nullable(); // Logo du GTT
        $table->string('cover_image')->nullable(); // Image de couverture de leur page
        //$table->boolean('is_active')->default(true);
        $table->boolean('is_published')->default(false);
        $table->date('published_at')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gtts');
    }
};
