<?php

namespace App\Filament\Resources\Zoonoses\Pages;

use App\Filament\Resources\Zoonoses\ZoonoseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZoonoses extends ListRecords
{
    protected static string $resource = ZoonoseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
