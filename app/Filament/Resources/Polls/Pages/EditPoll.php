<?php
namespace App\Filament\Resources\Polls\Pages;

use App\Filament\Resources\Polls\PollResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditPolls extends EditRecord
{
    protected static string $resource = PollResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}