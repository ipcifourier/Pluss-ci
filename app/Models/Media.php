<?php

/*namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'type', 'external_link', 
        'file_path', 'cover_image_path', 'is_published', 'published_at'
    ];

    /*protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'date',
    ];

    protected $guarded = [];

    protected $casts = [
        'is_public' => 'boolean',
        'published_at' => 'date',
        'gallery_images' => 'array', // <--- INDISPENSABLE pour l'album
    ];
}*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    // 👇 C'est ICI que ça bloquait ! On autorise tous les champs.
    protected $fillable = [
        'type',
        'title',
        'slug',
        'cover_image',    // <--- Il manquait sûrement lui
        'audio_file',     // <--- et lui
        'video_url',      // <--- et lui
        'gallery_images', // <--- et lui
        'description',
        'published_at',
        'is_public',
    ];

    // On dit à Laravel que 'gallery_images' est un tableau (JSON), pas juste du texte
    protected $casts = [
        'gallery_images' => 'array',
        'published_at' => 'date',
        'is_public' => 'boolean',
    ];

    // Cette fonction transforme automatiquement les liens YouTube pour l'intégration
    public function getEmbedUrlAttribute()
    {
        if ($this->type === 'video' && $this->video_url) {
            // On extrait l'ID de la vidéo (ex: dQw4w9WgXcQ)
            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $this->video_url, $matches);
            
            // Si on a trouvé un ID, on retourne le lien Embed
            return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : $this->video_url;
        }
        return null;
    }
}