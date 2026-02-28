<?php

namespace App\Filament\Resources\Gtts\Pages;

use App\Filament\Resources\Gtts\GttResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGtts extends ListRecords
{
    protected static string $resource = GttResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
