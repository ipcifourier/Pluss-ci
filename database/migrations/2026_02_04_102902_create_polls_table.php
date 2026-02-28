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
    Schema::create('polls', function (Blueprint $table) {
        $table->id();
        $table->string('question');
        $table->json('options'); // C'est ici que la magie opère (Labels + Compteurs)
        $table->boolean('is_active')->default(true);
        $table->date('ends_at')->nullable(); // Date de fin du sondage
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('polls');
    }
};
