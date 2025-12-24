<?php

namespace App\Filament\Resources\Business\Categories\Pages;

use App\Filament\Resources\Business\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
