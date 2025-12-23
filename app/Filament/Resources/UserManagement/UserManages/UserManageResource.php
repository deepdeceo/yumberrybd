<?php

namespace App\Filament\Resources\UserManagement\UserManages;

use App\Filament\Resources\UserManagement\UserManages\Pages\CreateUserManage;
use App\Filament\Resources\UserManagement\UserManages\Pages\EditUserManage;
use App\Filament\Resources\UserManagement\UserManages\Pages\ListUserManages;
use App\Filament\Resources\UserManagement\UserManages\Schemas\UserManageForm;
use App\Filament\Resources\UserManagement\UserManages\Tables\UserManagesTable;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserManageResource extends Resource
{
    protected static ?string $model = User::class;
 protected static string|BackedEnum|null $navigationIcon = Heroicon::User;
    protected static string|UnitEnum|null $navigationGroup = 'User Management';


    public static function form(Schema $schema): Schema
    {
        return UserManageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserManagesTable::configure($table);
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
            'index' => ListUserManages::route('/'),
            'create' => CreateUserManage::route('/create'),
            'edit' => EditUserManage::route('/{record}/edit'),
        ];
    }
}
