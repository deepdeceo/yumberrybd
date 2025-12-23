<?php

namespace App\Filament\Resources\UserManagement\PartnerManages;

use App\Filament\Resources\UserManagement\PartnerManages\Pages\CreatePartnerManage;
use App\Filament\Resources\UserManagement\PartnerManages\Pages\EditPartnerManage;
use App\Filament\Resources\UserManagement\PartnerManages\Pages\ListPartnerManages;
use App\Filament\Resources\UserManagement\PartnerManages\Schemas\PartnerManageForm;
use App\Filament\Resources\UserManagement\PartnerManages\Tables\PartnerManagesTable;
use App\Models\UserManagement\Partner;
use App\Models\UserManagement\PartnerManage;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartnerManageResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserCircle;
    protected static string|UnitEnum|null $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return PartnerManageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnerManagesTable::configure($table);
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
            'index' => ListPartnerManages::route('/'),
            'create' => CreatePartnerManage::route('/create'),
            'edit' => EditPartnerManage::route('/{record}/edit'),
        ];
    }
}
