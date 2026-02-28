<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /*public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }*/
        public function up(): void
{
    /*Schema::create('media', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('type'); // 'youtube', 'audio', 'video_local'
        $table->string('external_link')->nullable(); // Pour YouTube
        $table->string('file_path')->nullable();     // Pour le MP3
        $table->string('cover_image_path')->nullable(); // Une image pour illustrer
        $table->boolean('is_published')->default(true);
        $table->date('published_at')->nullable();
        $table->timestamps();*/
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            
            // Le type permet de choisir l'affichage (audio, video, ou album)
            $table->string('type')->default('video'); // Options: 'audio', 'video', 'album'
            
            $table->string('cover_image')->nullable(); // Image de couverture pour tous
            
            // Les champs spécifiques (nullable car on ne remplit pas tout à la fois)
            $table->string('audio_file')->nullable();  // Pour le Podcast MP3
            $table->string('video_url')->nullable();   // Pour YouTube
            $table->json('gallery_images')->nullable(); // Pour l'Album Photo
            
            $table->text('description')->nullable();
            $table->date('published_at')->default(now());
            $table->boolean('is_public')->default(true);
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
