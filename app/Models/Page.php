<?php

/*namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
}*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    // Autorise tous les champs à être remplis
    protected $guarded = [];

    // Si tu as besoin de caster des types (optionnel pour l'instant)
    protected $casts = [
        'is_published' => 'boolean',
    ];
}
