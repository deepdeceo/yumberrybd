<?php

namespace App\Filament\Resources\Business\Cities\Pages;

use App\Filament\Resources\Business\Cities\CitiesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCities extends EditRecord
{
    protected static string $resource = CitiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
