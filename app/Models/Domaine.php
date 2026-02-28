<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Domaine extends Model
{
    //
    protected $fillable = [
        'titre',
        'slug',
        'description_courte',
        'contenu',
        'icone',
        'image_couverture',
        'ordre',
        'est_actif',
    ];
    protected $casts = [
        'est_actif' => 'boolean',
        'ordre' => 'integer',
    ];

     protected static function boot()
    {
        parent::boot();

        static::creating(function ($domaine) {
            if (empty($domaine->slug) && !empty($domaine->titre)) {
                $domaine->slug = Str::slug($domaine->titre);
            }
        });

        static::updating(function ($domaine) {
            // Si le titre change, on met à jour le slug ? Optionnel
            if ($domaine->isDirty('titre') && empty($domaine->slug)) {
                $domaine->slug = Str::slug($domaine->titre);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
}
