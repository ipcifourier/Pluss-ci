<?php

/*namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
}*/


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    // C'est cette ligne qui autorise l'enregistrement des données
    protected $fillable = [
        'title',
        'slug',
        'summary',      // (Si tu l'as mis dans la migration)
        'content',
        'image_path',
        'is_published',
        'published_at',
        'gtt_id',
        'is_event',
        'event_date',
        'event_location',
    ];
        // Option la plus simple : tout autoriser
//protected $guarded = [];
    

    // Indique à Laravel de traiter ces champs comme des dates (Carbon)
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'date',
        'event_date' => 'datetime',
        'is_event' => 'boolean',
        
    ];

     public function gtt(): BelongsTo
    {
        return $this->belongsTo(Gtt::class);
    }

    //Traitement pour les commentaires approuvés
    public function comments()
{
    return $this->hasMany(Comment::class)->where('is_approved', true)->latest();
}
}
