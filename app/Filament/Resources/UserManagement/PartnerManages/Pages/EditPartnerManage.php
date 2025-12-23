<?php

namespace App\Filament\Resources\UserManagement\PartnerManages\Pages;

use App\Filament\Resources\UserManagement\PartnerManages\PartnerManageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPartnerManage extends EditRecord
{
    protected static string $resource = PartnerManageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
