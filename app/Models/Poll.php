<?php

/*namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'options',
        'is_active',
        'ends_at',
    ];

    protected $casts = [
        'options' => 'array', // Indispensable pour le JSON
        'is_active' => 'boolean',
        'ends_at' => 'date',
    ];

}*/


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'options',
        'is_active',
        'ends_at',
    ];

    protected $casts = [
        'options' => 'array', // Transforme le JSON en tableau PHP automatiquement
        'is_active' => 'boolean',
        'ends_at' => 'date',
    ];

    // Cette fonction calcule le total des votes en additionnant la clé 'votes' de ton JSON
    public function getTotalVotesAttribute()
    {
        // On utilise collect() pour manipuler le tableau facilement
        return collect($this->options)->sum('votes');
    }
}