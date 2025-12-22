<?php

namespace App\Filament\Resources\Business\Zones\Pages;

use App\Filament\Resources\Business\Zones\ZonesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListZones extends ListRecords
{
    protected static string $resource = ZonesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
