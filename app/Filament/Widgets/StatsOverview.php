<?php

namespace App\Filament\Widgets;
use App\Models\ContactMessage;

use App\Models\Article;
use App\Models\Document;
use App\Models\Media;
use App\Models\Poll;
use App\Models\Subscriber; // <--- C'EST CETTE LIGNE QUI MANQUAIT !
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Données fictives pour la courbe des sondages (ou réelle si tu as le code DB)
        $pollTrend = [2, 4, 3, 10, 5, 8, 12]; 

        return [
            // 1. Articles
            Stat::make('Articles Publiés', Article::where('is_published', true)->count())
                ->description('Actualités en ligne')
                ->descriptionIcon('heroicon-m-newspaper')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            // 2. Documents
            Stat::make('Documents', Document::count())
                ->description('Rapports & Bulletins')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info'),

            // 3. Médiathèque
            Stat::make('Médiathèque', Media::count())
                ->description('Audios & Vidéos')
                ->descriptionIcon('heroicon-m-musical-note')
                ->color('warning'),

            // 4. Sondages
            Stat::make('Sondages Actifs', Poll::where('is_active', true)->count())
                ->description('Interaction Public')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->chart($pollTrend)
                ->color('primary'),

            // 5. Abonnés Newsletter (Celle qui plantait)
            Stat::make('Abonnés Newsletter', Subscriber::whereNull('unsubscribed_at')->count())
                ->description('Audience active')
                ->descriptionIcon('heroicon-m-envelope')
                ->chart([2, 3, 5, 4, 8, 12, 15])
                ->color('success'),
            
       
            Stat::make('Total Messages', ContactMessage::count())
                ->description('Tous les messages reçus')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('primary'),

            Stat::make('Non lus', ContactMessage::where('is_read', false)->count())
                ->description('À traiter d\'urgence')
                ->descriptionIcon('heroicon-m-bell')
                ->color('danger'), // Rouge pour alerter
                /*Stat::make('En attente de réponse', ContactMessage::where('is_read', true)->whereNull('response_at')->count())  
                ->description('À répondre rapidement')
                ->descriptionIcon('heroicon-m-clock') 
                ->color('warning'), // Orange pour signaler l'attente
             Stat::make('Répondus', ContactMessage::whereNotNull('response_at')->count())
                ->description('Messages traités')
                ->descriptionIcon('heroicon-m-check')
                ->color('success'), */// Vert pour les messages traités 
             
            /*Stat::make('Total GTT', Gtt::count())
                ->description('Nombre total de GTT')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'), */   
        ];
    }
}