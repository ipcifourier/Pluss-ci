<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Zoonose extends Model
{
    protected $fillable = [
        'titre',
        'slug',
        'description_courte',
        'contenu',
        'icone',
        'image_illustration',
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

        static::creating(function ($zoonose) {
            if (empty($zoonose->slug) && !empty($zoonose->titre)) {
                $zoonose->slug = Str::slug($zoonose->titre);
            }
        });

        static::updating(function ($zoonose) {
            if ($zoonose->isDirty('titre') && empty($zoonose->slug)) {
                $zoonose->slug = Str::slug($zoonose->titre);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}