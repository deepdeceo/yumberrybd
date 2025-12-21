<?php

namespace App\Filament\Resources\UserManagement\UserManages\Pages;

use App\Filament\Resources\UserManagement\UserManages\UserManageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserManages extends ListRecords
{
    protected static string $resource = UserManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
