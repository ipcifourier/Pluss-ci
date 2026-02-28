<?php

namespace App\Filament\Resources\Domaines\Pages;

use App\Filament\Resources\Domaines\DomaineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDomaine extends EditRecord
{
    protected static string $resource = DomaineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
