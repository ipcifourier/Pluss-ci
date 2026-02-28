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
        Schema::create('domaines', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('slug')->unique()->nullable(); // Ajout du champ slug unique et nullable
        $table->text('description_courte')->nullable();
        $table->longText('contenu'); // pour la modale
        $table->string('icone')->nullable(); // classe ou chemin d'icône
        $table->integer('ordre')->default(0);
        $table->boolean('est_actif')->default(true);
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domaines');
    }
};
