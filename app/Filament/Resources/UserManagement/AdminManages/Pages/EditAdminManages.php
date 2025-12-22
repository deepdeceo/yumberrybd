<?php

namespace App\Filament\Resources\UserManagement\AdminManages\Pages;

use App\Filament\Resources\UserManagement\AdminManages\AdminManagesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdminManages extends EditRecord
{
    protected static string $resource = AdminManagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
