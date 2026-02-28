<?php

namespace App\Filament\Resources\Zoonoses\Pages;

use App\Filament\Resources\Zoonoses\ZoonoseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditZoonose extends EditRecord
{
    protected static string $resource = ZoonoseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
