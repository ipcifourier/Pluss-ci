<?php
namespace App\Filament\Resources\Polls\Pages;

use App\Filament\Resources\Polls\PollResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListPolls extends ListRecords
{
    protected static string $resource = PollResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}