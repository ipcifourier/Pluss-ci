<?php
namespace App\Filament\Resources\Subscribers\Pages;

use App\Filament\Resources\Subscribers\SubscriberResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListSubscribers extends ListRecords
{
    protected static string $resource = SubscriberResource::class;
    protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; }
}