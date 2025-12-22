<?php

namespace App\Filament\Resources\UserManagement\AdminManages;

use App\Filament\Resources\UserManagement\AdminManages\Pages\CreateAdminManages;
use App\Filament\Resources\UserManagement\AdminManages\Pages\EditAdminManages;
use App\Filament\Resources\UserManagement\AdminManages\Pages\ListAdminManages;
use App\Filament\Resources\UserManagement\AdminManages\Schemas\AdminManagesForm;
use App\Filament\Resources\UserManagement\AdminManages\Tables\AdminManagesTable;
use App\Models\AdminPanel;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdminManagesResource extends Resource
{
    protected static ?string $model = AdminPanel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Users;

    protected static string|UnitEnum|null $navigationGroup = 'User Management';


    public static function form(Schema $schema): Schema
    {
        return AdminManagesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdminManagesTable::configure($table);
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
            'index' => ListAdminManages::route('/'),
            'create' => CreateAdminManages::route('/create'),
            'edit' => EditAdminManages::route('/{record}/edit'),
        ];
    }
}
