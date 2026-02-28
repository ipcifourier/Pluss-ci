<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'is_public' => 'boolean',
        'published_at' => 'date',
    ];

    // Liste des Types de documents
    public const TYPES = [
        'Rapport' => 'Rapport',
        'Bulletin' => 'Bulletin',
        'Arrêté' => 'Arrêté',
        'Décret' => 'Décret',
        'Loi' => 'Loi',
        'Stratégie' => 'Stratégie',
        'Convention' => 'Convention',
        'Guide technique' => 'Guide technique',
        'Décision' => 'Décision',
        'Autre' => 'Autre document',
    ];

    // Structure des Domaines et Sous-domaines (GHSA / Une Seule Santé)
    public const DOMAINS = [
        'PREVENIR' => [
            'Législation, Politique et financement nationaux',
            'Coordination, communication et promotion du RSI',
            'Résistance aux antimicrobiens',
            'Zoonoses',
            'Sécurité sanitaire des aliments',
            'Sécurité et sûreté biologiques',
            'Vaccination',
        ],
        'DETECTER' => [
            'Système national de laboratoires',
            'Surveillance en temps réel',
            'Notification',
            'Développement du personnel',
        ],
        'REPONDRE' => [
            'Préparation',
            'Interventions d\'urgence',
            'Lien entre la santé publique et les autorités chargées de la sécurité',
            'Moyens médicaux et déploiement de personnel',
            'Communication sur les risques',
        ],
        'AUTRES RISQUES' => [
            'Points d\'entrée',
            'Événements d\'origine chimique',
            'Situations d\'urgence radiologique',
        ],
    ];

    // Relation avec le GTT
    public function gtt(): BelongsTo
    {
        return $this->belongsTo(Gtt::class);
    }
}