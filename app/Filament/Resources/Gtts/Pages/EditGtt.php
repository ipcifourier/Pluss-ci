<?php

namespace App\Filament\Resources\Gtts\Pages;

use App\Filament\Resources\Gtts\GttResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGtt extends EditRecord
{
    protected static string $resource = GttResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
