<?php
namespace App\Filament\Resources\Subscribers\Pages;

use App\Filament\Resources\Subscribers\SubscriberResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions;

class EditSubscriber extends EditRecord
{
    protected static string $resource = SubscriberResource::class;
    protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; }
}