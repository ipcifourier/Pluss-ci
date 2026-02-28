<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // <--- IMPORTANT : N'oubliez pas cette ligne
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Article;

class Gtt extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'leader',
        'short_description',
        'description',
        'logo',
        'cover_image',
        'is_published',
        'published_at',
    ];

    // Indique à Laravel de traiter ces champs comme des dates (Carbon)
    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
    //


    /**
     * Définit la relation : Un GTT a plusieurs Articles (Activités)
     */

   


    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'gtt_id');
    }
}
