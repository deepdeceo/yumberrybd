<?php

namespace App\Filament\Resources\Business\Zones;

use App\Filament\Resources\Business\Zones\Pages\CreateZones;
use App\Filament\Resources\Business\Zones\Pages\EditZones;
use App\Filament\Resources\Business\Zones\Pages\ListZones;
use App\Filament\Resources\Business\Zones\Schemas\ZonesForm;
use App\Filament\Resources\Business\Zones\Tables\ZonesTable;
use App\Models\Business\Zones;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ZonesResource extends Resource
{
    protected static ?string $model = Zones::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|UnitEnum|null $navigationGroup = 'Business';

    public static function form(Schema $schema): Schema
    {
        return ZonesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ZonesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListZones::route('/'),
            'create' => CreateZones::route('/create'),
            'edit' => EditZones::route('/{record}/edit'),
        ];
    }
}
