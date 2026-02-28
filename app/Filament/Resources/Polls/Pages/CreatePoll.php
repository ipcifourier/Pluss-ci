<?php
namespace App\Filament\Resources\Polls\Pages;

use App\Filament\Resources\Polls\PollResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePolls extends CreateRecord
{
    protected static string $resource = PollResource::class;
}