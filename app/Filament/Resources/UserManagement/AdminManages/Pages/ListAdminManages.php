<?php

namespace App\Filament\Resources\UserManagement\AdminManages\Pages;

use App\Filament\Resources\UserManagement\AdminManages\AdminManagesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdminManages extends ListRecords
{
    protected static string $resource = AdminManagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
