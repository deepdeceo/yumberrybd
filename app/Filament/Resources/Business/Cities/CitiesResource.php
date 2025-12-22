<?php

namespace App\Filament\Resources\Business\Cities;

use App\Filament\Resources\Business\Cities\Pages\CreateCities;
use App\Filament\Resources\Business\Cities\Pages\EditCities;
use App\Filament\Resources\Business\Cities\Pages\ListCities;
use App\Filament\Resources\Business\Cities\Schemas\CitiesForm;
use App\Filament\Resources\Business\Cities\Tables\CitiesTable;
use App\Models\Business\Cities;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class CitiesResource extends Resource
{
    protected static ?string $model = Cities::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsVertical;

    protected static string|UnitEnum|null $navigationGroup = 'Business';

    public static function canViewAny(): bool
    {
        $user = Auth::guard('admin')->user();

        return in_array($user->role, ['super_admin', 'operation_manager']);
    }

    public static function form(Schema $schema): Schema
    {
        return CitiesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CitiesTable::configure($table);
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
            'index' => ListCities::route('/'),
            'create' => CreateCities::route('/create'),
            'edit' => EditCities::route('/{record}/edit'),
        ];
    }
}
