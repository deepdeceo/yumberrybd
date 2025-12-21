<?php

namespace App\Filament\Resources\UserManagement\UserManages\Pages;

use App\Filament\Resources\UserManagement\UserManages\UserManageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserManage extends EditRecord
{
    protected static string $resource = UserManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
