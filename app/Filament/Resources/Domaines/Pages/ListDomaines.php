<?php

namespace App\Filament\Resources\Domaines\Pages;

use App\Filament\Resources\Domaines\DomaineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDomaines extends ListRecords
{
    protected static string $resource = DomaineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
