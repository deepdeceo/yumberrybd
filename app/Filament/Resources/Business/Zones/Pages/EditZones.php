<?php

namespace App\Filament\Resources\Business\Zones\Pages;

use App\Filament\Resources\Business\Zones\ZonesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditZones extends EditRecord
{
    protected static string $resource = ZonesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
