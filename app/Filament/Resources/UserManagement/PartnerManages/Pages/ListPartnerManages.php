<?php

namespace App\Filament\Resources\UserManagement\PartnerManages\Pages;

use App\Filament\Resources\UserManagement\PartnerManages\PartnerManageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartnerManages extends ListRecords
{
    protected static string $resource = PartnerManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
